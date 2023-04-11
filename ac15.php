<?php
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/* AntaresCrypt Encryption Algorithm                                                              */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*
How to use?
Text Encryption
BASE64-ENCODED-DATA
<?php
$text = "This is text :)";
$key = "AntaresCrypt_v1_5";
# Use (Encrypt):
$encrypted_text = AntaresCrypt_v1_5::Encrypt($text,$key);
# Use (Decrypt):
$decrypted_text = AntaresCrypt_v1_5::Decrypt($encrypted_text,$key);
echo "Encrypted Text : ".$encrypted_text."<br>";
echo "Decrypted Text : ".$decrypted_text;
?>
File Encryption
GZIP-RAW-DATA
<?php
$text = "File-Data";
$key = "AntaresCrypt_v1_5";
# Use (Raw Encrypt):
$encrypted_text = AntaresCrypt_v1_5::Encrypt($text,$key,true);
# Use (Raw Decrypt):
$decrypted_text = AntaresCrypt_v1_5::Decrypt($encrypted_text,$key,true);
?>
*/
Class AntaresCrypt_v1_5
{
    Public Static Function Encrypt($string,$key,$file=null)
    {
        if($file==true)
        {
            $string=gzcompress($string,9);
        }
        $string=self::XOREncrypt(self::Raw_hexrev($string),hex2bin(hash("sha512",$key)));
        $salt=chr(0x33).chr(0xfb).chr(0xa4).chr(0x90).exp(pow(2,6));
        $salt=self::XOREncrypt($salt,$salt.chr(0xaf).chr(0xf2).chr(0xcc).chr(0x45).exp(pow(2,8)));
        $salt=self::Raw_hexrev(self::XOREncrypt($salt,$salt.chr(0xa3).chr(0x96).chr(0x64).chr(0x32).exp(pow(2,10))));
        $salt=self::XOREncrypt($salt,base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).self::Raw_hexrev(hex2bin(md5($key.sin(fmod(strlen($key),exp(0.2)/strlen($key))).cos(fmod(strlen($key),exp(0.2)/strlen($key))).tan(fmod(strlen($key),exp(0.2)/strlen($key)))))));
        $q=self::numHash($key.hex2bin(sha1(strlen(hash("whirlpool",hex2bin(sha1($salt.pow(2,32)))))*64+pow(2,84))),1);
        if($q!=0)
        {
            $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
        }
        $data_x_all=str_split($string,pow(2,8));
        $data=false;
        $veri=false;
        $salt=self::Raw_hexrev(base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).chr(0x12).chr(0x69).chr(0xf9).chr(0x45).exp(pow(2,5)));
        if($q!=0)
        {
            $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
        }
        $key=hex2bin(self::Hex_Dont_Count(hash("sha512",$key.$salt)));
        $block_counter=count($data_x_all);
        $counter=1;
        $counter_st=1;
        $counter_key=1;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Enc($str_x,$key);
            if($counter!=$block_counter)
            {
                $salt=false;
                $salt=chr(self::$salt_1_dat[$counter_key]);
                $q=self::numHash($key,1);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
                }
                if($counter_key==48)
                {
                    $counter_key=0;
                }
                $salt=self::XOREncrypt($key,hex2bin(hash("sha512",$key.$salt)));
                $key=hex2bin(sha1(strrev(utf8_encode($salt))).hash("gost",base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).$key.$salt.pow(2,24)*(substr(0,8,self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool",$key.$salt.$veri[1]))),8)))));
                $salt=false;
                $salt=chr(self::$salt_st_dat[$counter_st]);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_st_dat[$q]));
                }
                if($counter_st==48)
                {
                    $counter_st=0;
                }
            }
            $data=$data.$veri[0];
            $counter++;
            $counter_st++;
            $counter_key++;
        }
        $data.="==";
        if($file==true)
        {
            $data=base64_decode($data);
        }
        return $data;
    }
    Public Static Function Decrypt($string,$key,$file=null)
    {
        if($file==true)
        {
            $string=base64_encode($string);
        }
        $keyx=$key;
        $string=str_replace(" ","",trim(str_replace("=","",$string)));
        $salt=chr(0x33).chr(0xfb).chr(0xa4).chr(0x90).exp(pow(2,6));
        $salt=self::XOREncrypt($salt,$salt.chr(0xaf).chr(0xf2).chr(0xcc).chr(0x45).exp(pow(2,8)).tan(pow(2,34)));
        $salt=self::Raw_hexrev(self::XOREncrypt($salt,$salt.tan(pow(2,33)).chr(0xa3).chr(0x96).chr(0x64).chr(0x32).exp(pow(2,10))));
        $salt=self::XOREncrypt($salt,base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).self::Raw_hexrev(hex2bin(md5($key.sin(fmod(strlen($key),exp(0.2)/strlen($key))).cos(fmod(strlen($key),exp(0.2)/strlen($key))).tan(fmod(strlen($key),exp(0.2)/strlen($key)))))));
        $q=self::numHash($key.hex2bin(sha1(strlen(hash("whirlpool",hex2bin(sha1($salt.pow(2,32)))))*64+pow(2,84))),1);
        if($q!=0)
        {
            $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
        }
        $data_x_all=str_split($string,684);
        $data=false;
        $salt=self::Raw_hexrev(base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).chr(0x12).chr(0x69).chr(0xf9).chr(0x45).exp(pow(2,5)));
        if($q!=0)
        {
            $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
        }
        $key=hex2bin(self::Hex_Dont_Count(hash("sha512",$key.$salt)));
        $block_counter=count($data_x_all);
        $counter=1;
        $counter_st=1;
        $counter_key=1;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Dec($str_x,$key);
            if($counter!=$block_counter)
            {
                $salt=false;
                $salt=chr(self::$salt_1_dat[$counter_key]);
                $q=self::numHash($key,1);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_1_dat[$q]));
                }
                if($counter_key==48)
                {
                    $counter_key=0;
                }
                $salt=self::XOREncrypt($key,hex2bin(hash("sha512",$key.$salt)));
                $key=hex2bin(sha1(strrev(utf8_encode($salt))).hash("gost",base64_decode(self::$hash0.self::$hash1.self::$hash2.self::$hash3.self::$hash4.self::$hash5.self::$hash6.self::$hash7.self::$hash8.self::$hash9.self::$hasha.self::$hashb.self::$hashc.self::$hashd.self::$hashe.self::$hashf).$key.$salt.pow(2,24)*(substr(0,8,self::numHash(hex2bin(self::Hex_Dont_Count(hash("whirlpool",$key.$salt.$veri[1]))),8)))));
                $salt=false;
                $salt=chr(self::$salt_st_dat[$counter_st]);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_st_dat[$q]));
                }
                if($counter_st==48)
                {
                    $counter_st=0;
                }
            }
            $data=$data.$veri[0];
            $counter++;
            $counter_st++;
            $counter_key++;
        }
        $data=self::Raw_hexrev(self::XORDecrypt($data,hex2bin(hash("sha512",$keyx))));
        if($file==true)
        {
            $data=gzuncompress($data);
        }
        return $data;
    }
    Private Static Function Enc($string,$key)
    {
        $keyx=$key;
        $data_x_all=str_split($string,pow(2,7));
        $data=false;
        $nrk=false;
        $counter_key=1;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Crypt($str_x,"e",$key);
            if(strlen($string)>pow(2,7))
            {
                $salt=false;
                $salt=chr(self::$salt_2_dat[$counter_key]);
                $q=self::numHash($key,1);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_2_dat[$q]));
                }
                if($counter_key==48)
                {
                    $counter_key=0;
                }
                $counter_key++;
                $key=hex2bin(self::Hex_Dont_Count(hash("sha512",self::XOREncrypt(strrev(self::XOREncrypt($key.chr(0xb5).chr(0xb9),$salt)),$veri[1]).$salt.$veri[1])));
            }
            $data=$data.$veri[0];
            $nrk=$nrk.$veri[1];
        }
        $veri=false;
        $next_round_key=$nrk;
        $keyx=hex2bin(self::Hex_Dont_Count(hash("sha512",$keyx)));
        $data=strrev($data);
        return array($data,$next_round_key);
    }
    Private Static Function Dec($string,$key)
    {
        $data=trim($string);
        $data=strrev($data);
        $keyx=$key;
        $keyx=hex2bin(self::Hex_Dont_Count(hash("sha512",$keyx)));
        $data_x_all=str_split($data,342);
        $data=false;
        $nrk=false;
        $counter_key=1;
        foreach ($data_x_all as $str_x)
        {
            $veri=self::Crypt($str_x,"d",$key);
            if(strlen($string)>pow(2,7))
            {
                $salt=false;
                $salt=chr(self::$salt_2_dat[$counter_key]);
                $q=self::numHash($key,1);
                if($q!=0)
                {
                    $salt=self::XOREncrypt($salt,chr(self::$salt_2_dat[$q]));
                }
                if($counter_key==48)
                {
                    $counter_key=0;
                }
                $counter_key++;
                $key=hex2bin(self::Hex_Dont_Count(hash("sha512",self::XOREncrypt(strrev(self::XOREncrypt($key.chr(0xb5).chr(0xb9),$salt)),$veri[1]).$salt.$veri[1])));
            }
            $data=$data.$veri[0];
            $nrk=$nrk.$veri[1];
        }
        $veri=false;
        $next_round_key=$nrk;
        return array($data,$next_round_key);
    }
    Private Static Function Crypt($str1,$action="e",$key)
    {
        $keyx=$key;
        $ttt=hex2bin(self::Hex_Dont_Count(hash("sha512",md5($keyx))));
        $key=self::Hex_Dont_Count(hash("sha512",$key.$ttt.chr(0x3f).chr(0x6c).chr(0x33)));
        $keyz=self::Raw_hexrev(hex2bin(self::Hex_Dont_Count(hash("sha512",hex2bin($key)))));
        $keyy=self::Raw_hexrev(hex2bin(self::Hex_Dont_Count(hash("whirlpool",hex2bin(self::E_hex_1($key))))));
        $keyxor=hex2bin(self::Hex_Dont_Count(hash("whirlpool",hex2bin(md5(self::XOREncrypt(hex2bin($key),$keyy))))));
        $key444=self::hashtoXcode($key);
        $txa=hex2bin(self::Hex_Dont_Count(hash("sha512",self::Raw_hexrev(exp(pow(2,2)).self::XOREncrypt($keyz,$keyx)))));
        $txb=hex2bin(self::Hex_Dont_Count(hash("sha512",hex2bin(hash("whirlpool",$keyy)))));
        if($action=="e")
        {
            $bolum1=self::Raw_hexrev($str1);
            $bolum1=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum1),$keyx));
            $bolum1=self::Raw_hexrev($bolum1);
            $bolum1=hex2bin(strtr(bin2hex($bolum1),self::$hex_char,self::$change_5));
            $bolum1=hex2bin(self::E_hex_3(bin2hex($bolum1)));
            $bolum1=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum1),$txb));
            $bolum1=self::Raw_hexrev($bolum1);
            $bolum1=self::XOREncrypt(strrev($bolum1),$keyxor);
            $bolum1=hex2bin(strtr(bin2hex($bolum1),self::$hex_char,self::$change_a));
            $bolum1=hex2bin(strtr(bin2hex($bolum1),self::$hex_char,self::$change_f));
            $bolum1=hex2bin(self::E_hex_1(bin2hex($bolum1)));
            $bolum1=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum1),$keyx));
            $bolum1=self::XOREncrypt(strrev($bolum1),self::XOREncrypt($keyz,$keyxor));
            $bolum1=hex2bin(self::E_hex_2(bin2hex($bolum1)));
            $bolum1=self::Raw_hexrev($bolum1);
            $bolum1=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum1),$keyxor));
            $bolum1=strrev(bin2hex($bolum1));
            $bolum1=self::E_hex_1($bolum1);
            $hashed_key=self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(pow(4,5))));
            $sayac1=0;
            $harf=false;
            $harfler=str_split($bolum1,1);
            $harf_keyx=false;
            foreach($harfler as $harfx)
            {
                if($sayac1==pow(2,7))
                {
                    $sayac1=0;
                    $hashed_key=self::Hex_Dont_Count(bin2hex(openssl_random_pseudo_bytes(pow(4,5))));
                    $key=self::Hex_Dont_Count(hash("sha512",hex2bin($key).$ttt.chr(0x33).chr(0x99).chr(0xb4)));
                    $key444=self::hashtoXcode($key);
                }
                if($key444[$sayac1]==0)
                {
                    $harf=$harf.self::E_hex_1($harfx).$hashed_key[$sayac1];
                    $harf_keyx=$harf_keyx.$hashed_key[$sayac1];
                }
                else if($key444[$sayac1]==1)
                {
                    $harf=$harf.$hashed_key[$sayac1].self::E_hex_2($harfx);
                    $harf_keyx=$harf_keyx.$hashed_key[$sayac1];
                }
                else if($key444[$sayac1]==2)
                {
                    $harf=$harf.self::E_hex_1($harfx).self::hashtohash_1(self::hashtohash_1($hashed_key[$sayac1]));
                    $harf_keyx=$harf_keyx.self::hashtohash_1(self::hashtohash_1($hashed_key[$sayac1]));
                }
                else if($key444[$sayac1]==3)
                {
                    $harf=$harf.self::hashtohash_1($hashed_key[$sayac1]).self::E_hex_2($harfx);
                    $harf_keyx=$harf_keyx.self::hashtohash_1($hashed_key[$sayac1]);
                }
                $sayac1++;
            }
            $next_round_key=$harf_keyx;
            $harfler=false;
            $harfx=false; 
            $harf=self::E_hex_1($harf);
            $bolum2=hex2bin($harf);
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),3));
            $bolum2=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum2),$ttt));
            $bolum2=hex2bin(self::E_hex_2(bin2hex($bolum2)));
            $bolum2=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum2),$keyz));
            $bolum2=hex2bin(self::E_hex_1(bin2hex($bolum2)));
            $bolum2=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum2),$keyy));
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),1));
            $bolum2=hex2bin(self::E_hex_2(bin2hex($bolum2)));
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),3));
            $bolum2=hex2bin(self::E_hex_1(bin2hex($bolum2)));
            $bolum2=self::Raw_hexrev($bolum2);
            $bolum2=self::XOREncrypt(strrev($bolum2),$txa);
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),2));
            $bolum2=hex2bin(self::E_hex_3(bin2hex($bolum2)));
            $bolum2=self::XOREncrypt(strrev($bolum2),$keyz);
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),1));
            $bolum2=self::XOREncrypt(strrev($bolum2),$txa);
            $bolum2=hex2bin(self::E_hex_1(bin2hex($bolum2)));
            $bolum2=self::XOREncrypt(strrev($bolum2),$txb);
            $bolum2=hex2bin(self::E_Shift(bin2hex($bolum2),3));
            $bolum2=hex2bin(self::E_hex_2(bin2hex($bolum2)));
            $bolum2=hex2bin(self::Hex_Encrypt_Key(bin2hex($bolum2),$keyx));
            $bolum3=strtr(self::bk_kb(str_replace("=","",base64_encode($bolum2))),self::$base64_characters,self::$rot13_1);
            $sonuc=$bolum3;
        }    
        else if($action=="d")
        {
            $str1=trim($str1);
            $harf=$str1;
            $bolum1=base64_decode(self::bk_kb(strtr($harf,self::$rot13_1,self::$base64_characters)));
            $bolum1=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum1),$keyx));
            $bolum1=hex2bin(self::D_hex_2(bin2hex($bolum1)));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),3));
            $bolum1=strrev(self::XORDecrypt($bolum1,$txb));
            $bolum1=hex2bin(self::D_hex_1(bin2hex($bolum1)));
            $bolum1=strrev(self::XORDecrypt($bolum1,$txa));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),1));
            $bolum1=strrev(self::XORDecrypt($bolum1,$keyz));
            $bolum1=hex2bin(self::D_hex_3(bin2hex($bolum1)));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),2));
            $bolum1=strrev(self::XORDecrypt($bolum1,$txa));
            $bolum1=self::Raw_hexrev($bolum1);
            $bolum1=hex2bin(self::D_hex_1(bin2hex($bolum1)));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),3));
            $bolum1=hex2bin(self::D_hex_2(bin2hex($bolum1)));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),1));
            $bolum1=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum1),$keyy));
            $bolum1=hex2bin(self::D_hex_1(bin2hex($bolum1)));
            $bolum1=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum1),$keyz));
            $bolum1=hex2bin(self::D_hex_2(bin2hex($bolum1)));
            $bolum1=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum1),$ttt));
            $bolum1=hex2bin(self::D_Shift(bin2hex($bolum1),3));
            $bolum2=bin2hex($bolum1);
            $bolum2=self::D_hex_1($bolum2);
            $harfler=str_split($bolum2,2);
            $harf=false;
            $sayac1=0;
            $key444=self::hashtoXcode($key);
            $harf_key=false;
            foreach($harfler as $harfx)
            {
                if($sayac1==pow(2,7))
                {
                    $sayac1=0;
                    $key=self::Hex_Dont_Count(hash("sha512",hex2bin($key).$ttt.chr(0x33).chr(0x99).chr(0xb4)));
                    $key444=self::hashtoXcode($key);
                }
                if($key444[$sayac1]==0 or $key444[$sayac1]==2)
                {
                    $harf_sc=self::D_hex_1(substr($harfx,0,1));
                    $harf_keyx=substr($harfx,-1,1);
                }
                else if($key444[$sayac1]==1 or $key444[$sayac1]==3)
                {
                    $harf_sc=self::D_hex_2(substr($harfx,-1,1));
                    $harf_keyx=substr($harfx,0,1);
                }
                $sayac1++;
                $harf=$harf.$harf_sc;
                $harf_key=$harf_key.$harf_keyx;
            }
            $next_round_key=$harf_key;
            $harfler=false;
            $harfx=false;
            $harf=self::D_hex_1($harf);
            $bolum3=hex2bin(strrev($harf));
            $bolum3=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum3),$keyxor));
            $bolum3=self::Raw_hexrev($bolum3);
            $bolum3=hex2bin(self::D_hex_2(bin2hex($bolum3)));
            $bolum3=strrev(self::XORDecrypt($bolum3,self::XOREncrypt($keyz,$keyxor)));
            $bolum3=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum3),$keyx));
            $bolum3=hex2bin(self::D_hex_1(bin2hex($bolum3)));
            $bolum3=hex2bin(strtr(bin2hex($bolum3),self::$change_f,self::$hex_char));
            $bolum3=hex2bin(strtr(bin2hex($bolum3),self::$change_a,self::$hex_char));
            $bolum3=strrev(self::XORDecrypt($bolum3,$keyxor));
            $bolum3=self::Raw_hexrev($bolum3);
            $bolum3=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum3),$txb));
            $bolum3=hex2bin(self::D_hex_3(bin2hex($bolum3)));
            $bolum3=hex2bin(strtr(bin2hex($bolum3),self::$change_5,self::$hex_char));
            $bolum3=self::Raw_hexrev($bolum3);
            $bolum3=hex2bin(self::Hex_Decrypt_Key(bin2hex($bolum3),$keyx));
            $sonuc=self::Raw_hexrev($bolum3);
        }
        $next_round_key=hex2bin($next_round_key);
        return array($sonuc,$next_round_key);
    }
    Private Static Function numHash($str, $len=null)
    {
        $binhash=md5($str, true);
        $numhash=unpack('N2',$binhash);
        $hash=$numhash[1].$numhash[2];
        if($len && is_int($len))
        {
            $hash=substr($hash,0,$len);
        }
        return $hash;
    }
    Private Static Function Raw_hexrev($s)
    {
        $s_b=str_split(bin2hex($s),2);
        $s=null;
        foreach ($s_b as $s_a)
        {
            $s=$s.strrev($s_a);
        }
        return hex2bin($s);
    }
    Private Static Function E_Shift($data,$st)
    {
        if(strlen($data)%4==0)
        {
            if($st==1)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[1].$data_x[2].$data_x[3].$data_x[0];
                    $data=$data.$new_text;
                }
            }
            else if($st==2)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[2].$data_x[3].$data_x[0].$data_x[1];
                    $data=$data.$new_text;
                }
            }
            else if($st==3)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[3].$data_x[0].$data_x[1].$data_x[2];
                    $data=$data.$new_text;
                }
            }
        }
        else
        {
            $data=null;
        }
        return $data;
    }
    Private Static Function D_Shift($data,$st)
    {
        if(strlen($data)%4==0)
        {
            if($st==1)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[3].$data_x[0].$data_x[1].$data_x[2];
                    $data=$data.$new_text;
                }
            }
            else if($st==2)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[2].$data_x[3].$data_x[0].$data_x[1];
                    $data=$data.$new_text;
                }
            }
            else if($st==3)
            {
                $data_all=str_split($data,4);
                $data=null;
                foreach ($data_all as $data_x)
                {
                    $new_text=$data_x[1].$data_x[2].$data_x[3].$data_x[0];
                    $data=$data.$new_text;
                }
            }
        }
        else
        {
            $data=null;
        }
        return $data;
    }
    Private Static Function Hex_Dont_Count($data)
    {
        $data=trim($data);
        $lenght=strlen($data);
        if($lenght==pow(2,5))
        {
            $change_data=self::$change_9;
        }
        else if($lenght==pow(2,6))
        {
            $change_data=self::$change_2;
        }
        else if($lenght==pow(2,7))
        {
            $change_data=self::$change_5;
        }
        else
        {
            $change_data=self::$change_4;
        }
        for ($x = 0; $x <= $lenght; $x++)
        {
            if($x+1<$lenght)
            {
                if($data[$x]==$data[$x+1])
                {
                    if($data[$x]=="a")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_a);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="b")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_b);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="c")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_c);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="d")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_d);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="e")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_e);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="f")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_f);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="0")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_0);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="1")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_1);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="2")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_2);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="3")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_3);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="4")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_4);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="5")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_5);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="6")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_6);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="7")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_7);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="8")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_8);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    else if($data[$x]=="9")
                    {
                        $T=$data[$x];
                        $data[$x]=strtr($data[$x],self::$hex_char,self::$change_9);
                        if($data[$x]==$T)
                        {
                            $data[$x]=strtr($data[$x],self::$hex_char,$change_data);
                        }
                    }
                    $data[$x+1]=strtr($data[$x+1],self::$hex_char,$change_data);
                    $data[$x+1]=strtr($data[$x+1],self::$hex_char,$change_data);
                    $data[$x+1]=strtr($data[$x+1],self::$hex_char,$change_data);
                }
            }
        }
        return $data;
    }
    Private Static Function XOREncryption($InputString, $Key)
    {
        $KeyLength=strlen($Key);  
        for ($i=0;$i<strlen($InputString);$i++)
        {
            $rPos=$i%$KeyLength;
            $r=ord($InputString[$i])^ord($Key[$rPos]);
            $InputString[$i]=chr($r);
        }
        return $InputString;
    }
    Private Static Function XOREncrypt($InputString,$Key)
    {
        $InputString = self::XOREncryption($InputString,$Key);
        return $InputString;
    }
    Private Static Function XORDecrypt($InputString,$Key)
    {
        $InputString = self::XOREncryption($InputString,$Key);
        return $InputString;
    }
    Private Static Function bk_kb($data)
    {
        $str1="";
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if(strtolower($data[$i])==$data[$i])
            {
                $durum="0";
            }
            else if(strtoupper($data[$i])==$data[$i])
            {
                $durum="1";
            }
            if($durum=="1") 
            {
                $str1=$str1.strtolower($data[$i]);
            }
            else if($durum=="0")
            {
                $str1=$str1.strtoupper($data[$i]);
            }
        }
        return $str1;
    }
    Private Static Function Hex_Encrypt_Key($data,$key)
    {
        $key=self::Hex_Dont_Count(md5($key));
        $counter=0;
        for ($i=0;$i<=strlen($data)-1;$i++)
        {
            if($counter==pow(2,5))
            {
                $counter=0;
                $key=strtr($key,self::$hex_char,self::$hashchan);
            }
            if($key[$counter]=="a")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_a);
            }
            if($key[$counter]=="b")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_b);
            }
            if($key[$counter]=="c")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_c);
            }
            if($key[$counter]=="d")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_d);
            }
            if($key[$counter]=="e")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_e);
            }
            if($key[$counter]=="f")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_f);
            }
            if($key[$counter]=="0")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_0);
            }
            if($key[$counter]=="1")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_1);
            }
            if($key[$counter]=="2")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_2);
            }
            if($key[$counter]=="3")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_3);
            }
            if($key[$counter]=="4")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_4);
            }
            if($key[$counter]=="5")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_5);
            }
            if($key[$counter]=="6")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_6);
            }
            if($key[$counter]=="7")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_7);
            }
            if($key[$counter]=="8")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_8);
            }
            if($key[$counter]=="9")
            {
                $data[$i]=strtr($data[$i],self::$hex_char,self::$change_9);
            }
            $counter++;
        }
        return $data;
    }
    Private Static Function Hex_Decrypt_Key($data,$key)
    {
        $key=self::Hex_Dont_Count(md5($key));
        $counter=0;
        for ($i=0;$i<=strlen($data)-1;$i++)
        {
            if($counter==pow(2,5))
            {
                $counter=0;
                $key=strtr($key,self::$hex_char,self::$hashchan);
            }
            if($key[$counter]=="a")
            {
                $data[$i]=strtr($data[$i],self::$change_a,self::$hex_char);
            }
            if($key[$counter]=="b")
            {
                $data[$i]=strtr($data[$i],self::$change_b,self::$hex_char);
            }
            if($key[$counter]=="c")
            {
                $data[$i]=strtr($data[$i],self::$change_c,self::$hex_char);
            }
            if($key[$counter]=="d")
            {
                $data[$i]=strtr($data[$i],self::$change_d,self::$hex_char);
            }
            if($key[$counter]=="e")
            {
                $data[$i]=strtr($data[$i],self::$change_e,self::$hex_char);
            }
            if($key[$counter]=="f")
            {
                $data[$i]=strtr($data[$i],self::$change_f,self::$hex_char);
            }
            if($key[$counter]=="0")
            {
                $data[$i]=strtr($data[$i],self::$change_0,self::$hex_char);
            }
            if($key[$counter]=="1")
            {
                $data[$i]=strtr($data[$i],self::$change_1,self::$hex_char);
            }
            if($key[$counter]=="2")
            {
                $data[$i]=strtr($data[$i],self::$change_2,self::$hex_char);
            }
            if($key[$counter]=="3")
            {
                $data[$i]=strtr($data[$i],self::$change_3,self::$hex_char);
            }
            if($key[$counter]=="4")
            {
                $data[$i]=strtr($data[$i],self::$change_4,self::$hex_char);
            }
            if($key[$counter]=="5")
            {
                $data[$i]=strtr($data[$i],self::$change_5,self::$hex_char);
            }
            if($key[$counter]=="6")
            {
                $data[$i]=strtr($data[$i],self::$change_6,self::$hex_char);
            }
            if($key[$counter]=="7")
            {
                $data[$i]=strtr($data[$i],self::$change_7,self::$hex_char);
            }
            if($key[$counter]=="8")
            {
                $data[$i]=strtr($data[$i],self::$change_8,self::$hex_char);
            }
            if($key[$counter]=="9")
            {
                $data[$i]=strtr($data[$i],self::$change_9,self::$hex_char);
            }
            $counter++;
        }
        return $data;
    }
    Private Static Function encrypt_key($key,$data)
    {
        $key=self::Hex_Dont_Count(hash("md5",$key));
        $sayac0=0;
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if($sayac0==pow(2,5))
            {
                $sayac0=0;
                $key=strtr($key,self::$hex_char,self::$hashchan1);
            }
            if($key[$sayac0]=="0")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash0);
            }
            else if($key[$sayac0]=="1")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash1);
            }
            else if($key[$sayac0]=="2")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash2);
            }
            else if($key[$sayac0]=="3")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash3);
            }
            else if($key[$sayac0]=="4")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash4);
            }
            else if($key[$sayac0]=="5")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash5);
            }
            else if($key[$sayac0]=="6")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash6);
            }
            else if($key[$sayac0]=="7")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash7);
            }
            else if($key[$sayac0]=="8")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash8);
            }
            else if($key[$sayac0]=="9")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hash9);
            }
            else if($key[$sayac0]=="a")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hasha);
            }
            else if($key[$sayac0]=="b")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hashb);
            }
            else if($key[$sayac0]=="c")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hashc);
            }
            else if($key[$sayac0]=="d")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hashd);
            }
            else if($key[$sayac0]=="e")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hashe);
            }
            else if($key[$sayac0]=="f")
            {
                $data[$i]=strtr($data[$i],self::$base64_characters,self::$hashf);
            }
            $sayac0++;
        }
        return $data;
    }
    Private Static Function decrypt_key($key,$data)
    {
        $key=self::Hex_Dont_Count(hash("md5",$key));
        $sayac0=0;
        for ($i = 0; $i <= strlen($data)-1; $i++)
        {
            if($sayac0==pow(2,5))
            {
                $sayac0=0;
                $key=strtr($key,self::$hex_char,self::$hashchan1);
            }
            if($key[$sayac0]=="0")
            {
                $data[$i]=strtr($data[$i],self::$hash0,self::$base64_characters);
            }
            else if($key[$sayac0]=="1")
            {
                $data[$i]=strtr($data[$i],self::$hash1,self::$base64_characters);
            }
            else if($key[$sayac0]=="2")
            {
                $data[$i]=strtr($data[$i],self::$hash2,self::$base64_characters);
            }
            else if($key[$sayac0]=="3")
            {
                $data[$i]=strtr($data[$i],self::$hash3,self::$base64_characters);
            }
            else if($key[$sayac0]=="4")
            {
                $data[$i]=strtr($data[$i],self::$hash4,self::$base64_characters);
            }
            else if($key[$sayac0]=="5")
            {
                $data[$i]=strtr($data[$i],self::$hash5,self::$base64_characters);
            }
            else if($key[$sayac0]=="6")
            {
                $data[$i]=strtr($data[$i],self::$hash6,self::$base64_characters);
            }
            else if($key[$sayac0]=="7")
            {
                $data[$i]=strtr($data[$i],self::$hash7,self::$base64_characters);
            }
            else if($key[$sayac0]=="8")
            {
                $data[$i]=strtr($data[$i],self::$hash8,self::$base64_characters);
            }
            else if($key[$sayac0]=="9")
            {
                $data[$i]=strtr($data[$i],self::$hash9,self::$base64_characters);
            }
            else if($key[$sayac0]=="a")
            {
                $data[$i]=strtr($data[$i],self::$hasha,self::$base64_characters);
            }
            else if($key[$sayac0]=="b")
            {
                $data[$i]=strtr($data[$i],self::$hashb,self::$base64_characters);
            }
            else if($key[$sayac0]=="c")
            {
                $data[$i]=strtr($data[$i],self::$hashc,self::$base64_characters);
            }
            else if($key[$sayac0]=="d")
            {
                $data[$i]=strtr($data[$i],self::$hashd,self::$base64_characters);
            }
            else if($key[$sayac0]=="e")
            {
                $data[$i]=strtr($data[$i],self::$hashe,self::$base64_characters);
            }
            else if($key[$sayac0]=="f")
            {
                $data[$i]=strtr($data[$i],self::$hashf,self::$base64_characters);
            }
            $sayac0++;
        }
        return $data;
    }
    Private Static Function E_hex_1($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hex_1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_hex_1($sifrelenecek)
    {
        $kaynak = self::$hex_1;
        $hedef =  self::$hex_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_hex_2($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hex_2;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_hex_2($sifrelenecek)
    {
        $kaynak = self::$hex_2;
        $hedef =  self::$hex_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function E_hex_3($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hex_2;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_hex_3($sifrelenecek)
    {
        $kaynak = self::$hex_2;
        $hedef =  self::$hex_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function settingsgenerator($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$sg;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function settingsgenerator1($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$sg1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function settingsgenerator2($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$sg2;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function hashtoXcode($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hXc;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function hashtohash_1($sifrelenecek)
    {
        $kaynak = self::$hex_characters;
        $hedef =  self::$hth_1;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static Function D_rot13_4($sifrelenecek)
    {
        $kaynak = self::$rot13_4;
        $hedef =  self::$base64_characters;
        $yenikelime = strtr($sifrelenecek, $kaynak, $hedef);
        return $yenikelime;
    }
    Private Static $salt_1_dat=array(
        null,
        0xb6344ea53a78858c,0xe33daead79223282,0xeb4899565a4f247e,
        0x661e23ca76af0334,0xe3af624f648e6f58,0x100c42c3c9c7e9f3,
        0x36ce98d6b199e785,0x46100fe3f934b034,0x91a745e11415f03d,
        0x79daa5c944cbc586,0x684ac13d4b307b9c,0x13e9fab383110056,
        0x457f532f932a162f,0x182f3c17cfe4a06f,0xbdd7be8df2a224b9,
        0x28bc4718ed57a1b4,0x8a027afb9fb1ab75,0xce724d371a5aa6e5,
        0x6afcf7fc8cf8ca81,0x8172d2086a46a59b,0xfb85b937706d33b4,
        0xabeee9211a18029e,0x4310246e397ec0b4,0x49e64a595583d7b1,
        0xaf4dcaada0f7c0ae,0x3094ddda78aa529a,0xdc4a65c3593e079e,
        0x751926ac201a0ad9,0x45dafc4ba4cbcd64,0x675b05f9500f4cfa,
        0x45713a1ec18c58c8,0xc3aa7192d47842ca,0x6cbe789bdf4345bb,
        0x180b595d20d8b103,0x1f293f00b67ed388,0xc3d935b698b6a685,
        0x8dcfdbb16e71ec42,0x331bc8e42cc3cef1,0x76baf2bd606a8794,
        0x234943b6f873bc3a,0x97e6a35c0fe15cd7,0x632ec44657aafee4,
        0x9c9df59b6efbb6a2,0xb1b8d1f466b059d4,0x663d7c64a4aa625c,
        0x1dae4ebd43023921,0x7fbc88b1426813a9,0x0bf4c3738f049d40
    );
    Private Static $salt_2_dat=array(
        null,
        0xc6a44b0c05e19d2e,0xeeadaa3e1639cc1d,0xffccedc5155c5d2e,
        0x761926cf04adcf77,0xe6cf524ac8fd594c,0x500f4cc3af2f6f47,
        0x33df970e6a77391b,0x4f1101a7bba453e7,0x92a855d2e93e98ab,
        0xdb4541d2423d9340,0x5dc4c44ec99af427,0xd61ee1ad506401c5,
        0x925ad8a6aef31657,0x45cb8453364691f5,0x7e3f24bcbdfc86af,
        0xebf4f7d4f7772947,0x2f2ca5da3f2fc753,0xdcb45ee851df45fe,
        0xb7fccd7077fe18b4,0xc8f27a48d4f37ad8,0x14b9498a8c79287a,
        0xe8755369b45fa2eb,0x13ae81f0691f32b5,0xe6df0f48d67e3957,
        0xb6344ea53a78858c,0xe33daead79223282,0xeb4899565a4f247e,
        0x661e23ca76af0334,0xe3af624f648e6f58,0x100c42c3c9c7e9f3,
        0x36ce98d6b199e785,0x46100fe3f934b034,0x91a745e11415f03d,
        0x79daa5c944cbc586,0x684ac13d4b307b9c,0x13e9fab383110056,
        0x457f532f932a162f,0x182f3c17cfe4a06f,0xbdd7be8df2a224b9,
        0x28bc4718ed57a1b4,0x8a027afb9fb1ab75,0xce724d371a5aa6e5,
        0x6afcf7fc8cf8ca81,0x8172d2086a46a59b,0xfb85b937706d33b4,
        0xabeee9211a18029e,0x4310246e397ec0b4,0x49e64a595583d7b1
    );
    Private Static $salt_st_dat=array(
        null,
        0xaf4dcaada0f7c0ae,0x3094ddda78aa529a,0xdc4a65c3593e079e,
        0x751926ac201a0ad9,0x45dafc4ba4cbcd64,0x675b05f9500f4cfa,
        0x45713a1ec18c58c8,0xc3aa7192d47842ca,0x6cbe789bdf4345bb,
        0x180b595d20d8b103,0x1f293f00b67ed388,0xc3d935b698b6a685,
        0x8dcfdbb16e71ec42,0x331bc8e42cc3cef1,0x76baf2bd606a8794,
        0x234943b6f873bc3a,0x97e6a35c0fe15cd7,0x632ec44657aafee4,
        0x9c9df59b6efbb6a2,0xb1b8d1f466b059d4,0x663d7c64a4aa625c,
        0x1dae4ebd43023921,0x7fbc88b1426813a9,0x0bf4c3738f049d40,
        0xc6a44b0c05e19d2e,0xeeadaa3e1639cc1d,0xffccedc5155c5d2e,
        0x761926cf04adcf77,0xe6cf524ac8fd594c,0x500f4cc3af2f6f47,
        0x33df970e6a77391b,0x4f1101a7bba453e7,0x92a855d2e93e98ab,
        0xdb4541d2423d9340,0x5dc4c44ec99af427,0xd61ee1ad506401c5,
        0x925ad8a6aef31657,0x45cb8453364691f5,0x7e3f24bcbdfc86af,
        0xebf4f7d4f7772947,0x2f2ca5da3f2fc753,0xdcb45ee851df45fe,
        0xb7fccd7077fe18b4,0xc8f27a48d4f37ad8,0x14b9498a8c79287a,
        0xe8755369b45fa2eb,0x13ae81f0691f32b5,0xe6df0f48d67e3957
    );
    Private Static $hex_char= "abcdef0123456789";
    Private Static $change_a= "0951ab326c7f4e8d";
    Private Static $change_b= "183daf026795ebc4";
    Private Static $change_c= "53840edc67f1ba29";
    Private Static $change_d= "9ac612fd74538e0b";
    Private Static $change_e= "72c0fbe64d9531a8";
    Private Static $change_f= "a10fe82cd746b593";
    Private Static $change_0= "e7b8a246590c31df";
    Private Static $change_1= "28b5ae9cd340617f";
    Private Static $change_2= "17cf54839b062eda";
    Private Static $change_3= "d98601f2bac4573e";
    Private Static $change_4= "34b78915d0ae62fc";
    Private Static $change_5= "5bef680329c1ad74";
    Private Static $change_6= "df9b3a41c76e2580";
    Private Static $change_7= "9374d21c50fe8b6a";
    Private Static $change_8= "60f931edc7b5248a";
    Private Static $change_9= "2173049b6cea85df";
    Private Static $hashchan= "4f571ae03b9cd268";
    Private Static $hashchan1="94c37de51f80b6a2";
    Private Static $hex_characters="abcdef0123456789";
    Private Static $base64_characters="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+";
    Private Static $hex_1="549e30c67ba2f81d";
    Private Static $hex_2="e326a51d04789fcb";
    Private Static $hex_3="3bd45206fec9a718";
    Private Static $hXc="0132102013201203";
    Private Static $hth_1="61fa2bed734890c5";
    Private Static $rot13_1="4pvFr92x0jUfXHYomGO73LKID1lEaPNgdC6T5i8hBqSsnRy/eWuc+tJwQZbVAzkM";
    Private Static $rot13_2="wvnk0qN7MJpITosEUf8LhXzm91tYyC4eDAx2brOlHVgFK6u/Wc5Pia+SjRZQdGB3";
    Private Static $rot13_3="h/T2I5EbOmzxDHMBt603VA+a7GYcqJ9KQgUNZCWrRdveyswfSLun1F8pokPi4lXj";
    Private Static $rot13_4="JuEnkzSo2lMcXadLf5trjs486R3h7+pNZWHixUPq9CQw0gOvFeDVGy/1YbTBmKIA";
    Private Static $hash0="Lp2P/9DC+w7FeRto6nmOzjbcEQrTMhUZGiyS1f8xJaWYHNX3klsu0KAIVvB4qg5d";
    Private Static $hash1="752IFzi6SPaXrQsNYtwERHLUZCTO9xjmJclq1KuAknW0VD4gMbBGyv38/fehpo+d";
    Private Static $hash2="4zhwZkgPMG87lHRAaXK5uv0SFT9ycI6nEem/NJiVf2qY+jQsUWbtxo3LpDrOCBd1";
    Private Static $hash3="p4k90jRq786irMIoCUWnu+EeZaOhtyXgAL2dw51VQvmbG3HYJSfPxDNFsKzB/lcT";
    Private Static $hash4="HtigypvlBqSa94zkD5rPEUXMRY/LjdOJ+euVFoZn1h63GfINmWQKbTCxw782sc0A";
    Private Static $hash5="fEUAHgGCpodPNWh7w4v+/kc6OrmbKVSzy0tj8M32La5RiIlqXeJQ9xsZu1TFYBnD";
    Private Static $hash6="mTA4ONzeudspRMXQxbPLV5hi+gWG12Y/qDIrl3BUtjH9fo0vwSK67c8ykZnFCEJa";
    Private Static $hash7="EN4+2QLUPqthmj/KGaRJvkdln6SAwObpVeI30szDyCiW7u8fxgZc9BTHYX1rM5Fo";
    Private Static $hash8="opAR3+ScPdLJaOeVQmhN4BF9rKM267/wkyGXTUYDnxHvjZ8itqECu0bIgszlf5W1";
    Private Static $hash9="mVgZR0GHbx+OeskhAv2yLBW1fY5Fjl4EudnMiP/pTJ6NqX8a93SoDQ7IrtcwUCKz";
    Private Static $hasha="VOW3Mg7vdUx5rhYQFcz2jKotE0uP9lNy4I1mnpsqaLiCAB6J+R8GZTefXwbkDS/H";
    Private Static $hashb="08TjDklwrCpAgH7GsU3QIvBaROZEM+o/fni1XFLVyxYhPzW629t4JKmSuNbd5eqc";
    Private Static $hashc="D1396NatCpQydIhzMnlFvYS/iLu7eAG8BbOxqoUVX5+rjH2EWRKP4TmgwZsfc0Jk";
    Private Static $hashd="3QjE5SfU+Y1MVbIy0a6Zm8hKoO4e2tcnFdR9uXrpWJGCxlAsvBT/kzDwiNgqP7LH";
    Private Static $hashe="hRa4QoBy5blILAusSC/YFXKr6qpfP9c2N13TUvtZJxGWw0e+DOM7z8idVjgHEmkn";
    Private Static $hashf="fX+0wuaDgj4U8GKBHPF17ATq3vpm9SVICkoY/RJxMeOZiQbLsdn2WNhtyrl5z6cE";
}
?>