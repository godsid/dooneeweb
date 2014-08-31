import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;


public class hash_hmac_sha1 {

	public static String hmacSha1(String value, String key) {
        try {
            // Get an hmac_sha1 key from the raw key bytes
            byte[] keyBytes = key.getBytes();           
            SecretKeySpec signingKey = new SecretKeySpec(keyBytes, "HmacSHA1");

            // Get an hmac_sha1 Mac instance and initialize with the signing key
            Mac mac = Mac.getInstance("HmacSHA1");
            mac.init(signingKey);

            // Compute the hmac on input data bytes
            byte[] rawHmac = mac.doFinal(value.getBytes());

            // Convert raw bytes to Hex
           // byte[] hexBytes = Base64Coder.encode(rawHmac);

            //  Covert array of Hex bytes to a String
            return byteArrayToHexString(rawHmac);
        } catch (Exception e) {
            throw new RuntimeException(e);
        }
    }
	static String byteArrayToHexString(byte in[]) {

        byte ch = 0x00;
        int i = 0;
        if (in == null || in.length <= 0)
                return null;

        String pseudo[] = { "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F" };
        StringBuffer out = new StringBuffer(in.length * 2);

        while (i < in.length) {
                ch = (byte) (in[i] & 0xF0); // Strip offhigh nibble
                ch = (byte) (ch >>> 4);
                // shift the bits down
                ch = (byte) (ch & 0x0F);
                // must do this is high order bit is on!
                out.append(pseudo[ch]); // convert thenibble to a String
                // Character
                ch = (byte) (in[i] & 0x0F); // Strip off low nibble
                out.append(pseudo[ch]); // convert the nibble to a String
                // Character
                i++;
        }
        String rslt = new String(out);
        return rslt;
}

}
