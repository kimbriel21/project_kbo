<?php

namespace App\Http\Controllers\CryptoCurrency;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Globals\jsonRPCClient;

use Request;


class Wallet extends Controller
{
	private $jsonrpc;
	private $uri;

	function __construct()
	{
		// parent::__construct("159.89.205.160", "2332", "user", "password");
    // $this->middleware('jwt.auth');
		$this->jsonrpc = new jsonRPCClient("http://user:password@159.89.205.160:2332/");
	}

	function wallet()
	{
		// 
		$user_key = 'kimkim';

		$data['user_key'] = $user_key;
		$data['balance'] = $this->getBalance($user_key,8);
		$data['address'] = $this->getAddress($user_key);
		$data['address_list'] = $this->getAddressList($user_key);
		
		return view('crypto.wallet_view', $data);
	}

  function get_wallet_balance($user_key)
  {
    return $this->getBalance($user_key,8);
  }


  function get_transaction_list()
  {
    $user_key = Request::input('user_key');
    
    $data['count'] = 1;
    $data['trasaction_list'] = $this->getTransactionList($user_key);
    return view('crypto.transaction_list_table', $data);
  }

  function send_coin_request()
  {
      $user_key = Request::input('user_key');
      $address = Request::input('address');
      $amount  = Request::input('amount');

      $this->send_coin($user_key, $address, 1);

      $data['success'] = 'done';

      return json_encode($data);
  }

  function getBalance($user_session, $decimal_places)
 	{
 		return sprintf("%.".$decimal_places."f", $this->jsonrpc->getbalance("zelles(" . $user_session . ")", 6));
 		//return 21;
 	}

  function getAddress($user_session)
  {
      return $this->jsonrpc->getaccountaddress("zelles(" . $user_session . ")");
 	}

 	function getAddressList($user_session)
 	{
 		return $this->jsonrpc->getaddressesbyaccount("zelles(" . $user_session . ")");
 		//return array("1test", "1test");
 	}

 	function getTransactionList($user_session, $limit = 0)
 	{
 		if ($limit == 0) 
 		{
 			return $this->jsonrpc->listtransactions("zelles(" . $user_session . ")", 10);
 		}
 		else
 		{
 			return $this->jsonrpc->listtransactions("zelles(" . $user_session . ")", $limit);
 		}
 		
 	}

 	function getNewAddress($user_session)
 	{
 		return $this->jsonrpc->getnewaddress("zelles(" . $user_session . ")");
 		//return "1test";
 	}

 	function send_coin($user_session, $address, $amount)
 	{
 		return $this->jsonrpc->sendfrom("zelles(" . $user_session . ")", $address, (float)$amount, 6);
 		//return "ok wow";
 	}
}
