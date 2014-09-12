using System;
using System.Collections.Generic;
using System.Text;
//test
namespace SinaptiqPKCS7Test
{
    class Sample
    {
        static void Main(string[] args)
        {
            SinaptIQPKCS7.PKCS7 pkcs7 = new SinaptIQPKCS7.PKCS7();
     
            Console.WriteLine(DateTime.Now.ToString("yyyy/MM/dd : hh:mm:ss fff") + " SENDER PART");
            string clearMsg = "";
            string inputMsg = "Hello";
            Console.WriteLine(DateTime.Now.ToString("yyyy/MM/dd : hh:mm:ss fff") + " Input Message : " + inputMsg);

             string base64Str = pkcs7.encryptMessage(inputMsg, pkcs7.getPublicCert("123Public.cer"));

             clearMsg = pkcs7.decryptMessage(base64Str, pkcs7.getPrivateCert("MerchantPrivate(123).pfx", "123"));
         
            Console.WriteLine(DateTime.Now.ToString("yyyy/MM/dd : hh:mm:ss fff") + " Clear Message : " + clearMsg);
           
            Console.Read();
        }
    }
}
