 public class hash_hmac_sha1
 {
 
 private string getHMAC(string signatureString, string secretKey)
    {
       

        System.Text.UTF8Encoding encoding = new System.Text.UTF8Encoding();

        byte[] keyByte = encoding.GetBytes(secretKey);

        
        HMACSHA1 hmac = new HMACSHA1(keyByte);
       

        byte[] messageBytes = encoding.GetBytes(signatureString);

        byte[] hashmessage = hmac.ComputeHash(messageBytes);

       
        return ByteArrayToHexString(hashmessage);

    }
    private string ByteArrayToHexString(byte[] Bytes)
    {
      
        string HexAlphabet = "0123456789ABCDEF";

        foreach (byte B in Bytes)
        {
            Result.Append(HexAlphabet[(int)(B >> 4)]);
            Result.Append(HexAlphabet[(int)(B & 0xF)]);
        }

        return Result.ToString();
    }
 }