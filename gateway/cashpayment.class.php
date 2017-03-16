<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

class Phpfox_Gateway_Api_CashPayment implements Phpfox_Gateway_Interface
{
	/**
	 * Holds an ARRAY of settings to pass to the form
	 *
	 * @var array
	 */
	private $_aParam = array();


	/**
	 * Class constructor
	 *
	 */
	public function __construct()
	{

	}

	/**
	 * Set the settings to be used with this class and prepare them so they are in an array
	 *
	 * @param array $aSetting ARRAY of settings to prepare
	 */
	public function set($aSetting)
	{
		$this->_aParam = $aSetting;

		if (Phpfox::getLib('parse.format')->isSerialized($aSetting['setting']))
		{
			$this->_aParam['setting'] = unserialize($aSetting['setting']);
		}
	}

	/**
	 * Each gateway has a unique list of params that must be passed with the HTML form when posting it
	 * to their site. This method creates that set of custom fields.
	 *
	 * @return array ARRAY of all the custom params
	 */
	public function getEditForm()
	{
		return [
			'seller_id' => [
				'phrase' => _p('Do enable Cach Payment for you?'),
				'phrase_info' => _p('Any symbol for enable, empty for disable'),
				'value' => Phpfox::getUserId()
			]
		];
	}

	/**
	 * Returns the actual HTML <form> used to post information to the 3rd party gateway when purchasing
	 * an item using this specific payment gateway
	 *
	 * @return bool FALSE if we can't use this payment gateway to purchase this item or ARRAY if we have successfully created a form
	 */
	public function getForm()
	{
		if (isset($this->_aParam['setting']['seller_id']) && $this->_aParam['setting']['seller_id']) {
			$aForm = array(
				'url' => Phpfox_Url::instance()->makeUrl('cashpayment.buy'),
				'param' => array(
					'seller_id' => $this->_aParam['setting']['seller_id'],
					'buyer_id' => Phpfox::getUserId(),
					'item_name' => $this->_aParam['item_name'],
					'item_number' => $this->_aParam['item_number'],
					'currency_code' => $this->_aParam['currency_code'],
					'return' => $this->_aParam['return'],
				)
			);
			$aForm['param']['amount'] = $this->_aParam['amount'];
			return $aForm;
		} else {
			return false;
		}
	}

	/**
	 * Performs the callback routine when the 3rd party payment gateway sends back a request to the server,
	 * which we must then back and verify that it is a valid request. This then connects to a specific module
	 * based on the information passed when posting the form to the server.
	 *
	 */
	public function callback()
	{
		Phpfox::log('Starting CashPayment callback');

		Phpfox::log('Attempting callback');

		Phpfox::log('Callback OK');

		$isApp = false;
		$aParts = explode('|', $this->_aParam['item_number']);
		if (substr($aParts[0], 0, 5) == '@App/') {
			$isApp = true;
			Phpfox::log('Is an APP.');
		}

		Phpfox::log('Attempting to load module: ' . $aParts[0]);

		if ($isApp || Phpfox::isModule($aParts[0]))
		{
			Phpfox::log('Module is valid.');
			Phpfox::log('Checking module callback for method: paymentApiCallback');
			if ($isApp || (Phpfox::isModule($aParts[0]) && Phpfox::hasCallback($aParts[0], 'paymentApiCallback')))
			{
				Phpfox::log('Module callback is valid.');
				Phpfox::log('Building payment status: ' . (isset($this->_aParam['payment_status']) ? $this->_aParam['payment_status'] : '') . ' (' . (isset($this->_aParam['txn_type']) ? $this->_aParam['txn_type'] : '') . ')');

				$sStatus = $this->_aParam['status'];

				Phpfox::log('Status built: ' . $sStatus);

				Phpfox::log('Executing module callback');

				$params = array(
					'gateway' => 'cashpayment',
					'ref' => $this->_aParam['item_number'],
					'status' => $sStatus,
					'item_number' => $aParts[1],
					'total_paid' => $this->_aParam['amount'],
				);

				if ($isApp) {
					$callback = str_replace('@App/', '', $aParts[0]);
					Phpfox::log('Running app callback on: ' . $callback);
					\Core\Payment\Trigger::event($callback, $params);
				}
				else {
					Phpfox::callback($aParts[0] . '.paymentApiCallback', $params);
				}
			}
			else
			{
				Phpfox::log('Module callback is not valid.');
			}
		}
		else
		{
			Phpfox::log('Module is not valid.');
		}

	}
}