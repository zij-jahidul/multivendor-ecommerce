<?php
namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait CommonFunctionTrait
{
	/**
	 * Decode public key from SSO
	 *
	 * @param array $tocken
	 
	 * @return boolean
	 */
	protected function decodeKey($token)
	{	

		$oritoken = $this->deEncryptToken($token);
		$key = 'WbUVSk7i3ZLhF1fYjqPPKQZGKdACOsmXQ87Xk06pMj9ZPpZ6WVHtSRbTHeziuyMp';
	
           // JWT::$leeway += 1;    
          //  $tokenPayload = JWT::decode($oritoken, new Key(config('jwt.secret'), 'HS256'));
		 	$tokenPayload = JWT::decode($oritoken, new Key($key, 'HS256'));
			if($tokenPayload->role != 'common user'){
				return false;
			}

			//print_r($tokenPayload);
			//die('eeee');
            $user = User::query()->where('user_uid' , $tokenPayload->user_uid)->first();
            if($user){
				auth()->login($user, true);
                return true;
            }
            else{
		
				$user = new User([
						'user_uid' => $tokenPayload->user_uid,
						'name' => $tokenPayload->first_name . ' '. $tokenPayload->last_name,
						'email' => $tokenPayload->email,
						'phone'=> $tokenPayload->phone,
						//'password' => bcrypt($request->password),
						'verification_code' => rand(100000, 999999)
				]);	
		
				$user->email_verified_at = date('Y-m-d H:m:s');
				//$user->email_verified_at = null;
				
				$user->save();
		
				auth()->login($user, true);
			

                return true;
            }    		
	
	}

	function loadUserByUid($uid){
		$user = User::query()->where('user_uid' , $uid)->first();
		if($user){
			return $user;
		}else{
			return '';
		}
	} 

	function deEncryptToken($token) {
		$explode = explode('.', $token);
		if(count($explode) == 3)
			return $explode[1] . '.' . strrev($explode[0])  . '.' . $explode[2];
		return 0;
		
	}
	

}
