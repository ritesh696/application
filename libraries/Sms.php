<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Sms
{
	
	public function send_OTP($mobile_no,$otp)
	{
		return 1;
    exit;
		$template_name = 'otp_template';
	 	$api = "9212b619-12fc-11e7-9462-00163ef91450";
		
		$curl = curl_init();

    	  curl_setopt_array($curl, array(
          CURLOPT_URL => "http://2factor.in/API/V1/$api/SMS/$mobile_no/$otp/$template_name",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err)
         {
     	    return  $response = "cURL Error #:" . $err;   
            exit;        
        }
        else
        {
        	return '1';
        	exit;
        }    
	}
  public function send_sms($mobile_no,$template_name,$var1=0,$var2=0)
  {
    return 1;
    exit;
    //$template_name = 'otp_template';
    $From = 'SWAPIEE';
    $api = "9212b619-12fc-11e7-9462-00163ef91450";
    
    $curl = curl_init();

         $agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
        $url = "https://2factor.in/API/V1/$api/ADDON_SERVICES/SEND/TSMS"; 
        $ch = curl_init(); 
        curl_setopt($ch,CURLOPT_URL,$url); 
        curl_setopt($ch,CURLOPT_POST,true); 
        curl_setopt($ch,CURLOPT_POSTFIELDS,"TemplateName=$template_name&From=$From&To=$mobile_no&VAR1=$var1&VAR2=$var2"); 
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
         curl_exec($ch); 
        curl_close($ch)
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err)
         {
          return  $response = "cURL Error #:" . $err;   
            exit;        
        }
        else
        {
          return '1';
          exit;
        }    
  }


}

?>