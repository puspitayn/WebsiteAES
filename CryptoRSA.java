package com.example.finalproject_1.domain.usecase;
import android.util.Log;

import java.nio.charset.StandardCharsets;
import java.security.KeyPair;
import java.security.KeyPairGenerator;
import javax.crypto.Cipher;
import javax.crypto.SecretKeyFactory;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.spec.PBEKeySpec;
import javax.crypto.spec.SecretKeySpec;

import java.io.IOException;
import java.security.GeneralSecurityException;
import java.security.KeyFactory;
import java.security.MessageDigest;
import java.security.SecureRandom;
import java.security.interfaces.RSAPrivateKey;
import java.security.interfaces.RSAPublicKey;
import java.security.spec.KeySpec;
import java.security.spec.PKCS8EncodedKeySpec;
import java.security.spec.X509EncodedKeySpec;
import java.util.Base64;
import java.util.Random;
import static android.util.Base64.DEFAULT;


public class CryptoRSA {
    public CryptoRSA(){}

//    public static String getPublicKeyfromDatabase(){
//        final String[] pubKey = new String[1];
//        FirebaseFirestore db = FirebaseFirestore.getInstance();
//        DocumentReference pubKeyReference;
//        pubKeyReference = db.collection("key").document("public");
//        pubKeyReference.get().addOnSuccessListener(new OnSuccessListener<DocumentSnapshot>() {
//            @Override
//            public void onSuccess(DocumentSnapshot snapshot) {
//                pubKey[0] = snapshot.getString("publicKey");
//            }
//        }).addOnFailureListener(new OnFailureListener() {
//            @Override
//            public void onFailure(@NonNull Exception e) {
//                Log.d("DEBUG:fetchServerPubKey", "Failed");
//            }
//        });
//        return pubKey[0];
//    }

    public static RSAPublicKey getPublicKeyFromString(String key) throws IOException, GeneralSecurityException {
        String publicKeyPEM = key;
        publicKeyPEM = publicKeyPEM.replace("-----BEGIN PUBLIC KEY-----", "");
        publicKeyPEM = publicKeyPEM.replace("-----END PUBLIC KEY-----", "");
        publicKeyPEM = publicKeyPEM.replace("\n","");
        //Log.d("DEBUG:pubKeyPem", publicKeyPEM);
        byte[] decoded = android.util.Base64.decode(publicKeyPEM, DEFAULT);
        KeyFactory kf = KeyFactory.getInstance("RSA");
        RSAPublicKey pubKey = (RSAPublicKey) kf.generatePublic(new X509EncodedKeySpec(decoded));
        return pubKey;
    }

    public static RSAPrivateKey getPrivateKeyFromString(String key) throws Exception, GeneralSecurityException{
        String privateKeyPem = key;
        privateKeyPem = privateKeyPem.replace("-----BEGIN PRIVATE KEY-----", "");
        privateKeyPem = privateKeyPem.replace("-----END PRIVATE KEY-----","");
        privateKeyPem = privateKeyPem.replace("\n","");
        byte[] decoded = android.util.Base64.decode(privateKeyPem, DEFAULT);
        KeyFactory kf = KeyFactory.getInstance("RSA");
        RSAPrivateKey privKey = (RSAPrivateKey) kf.generatePrivate(new PKCS8EncodedKeySpec(decoded));
        return privKey;
    }

    public static String generateRandomHex(){
        Random rand = new SecureRandom();
        byte[] bytesRandom = new byte[16];
        rand.nextBytes(bytesRandom);
        String random = bytesRandom.toString();
        Log.d("DEBUG:encryption", "Generated Hex : "+random);
        return random;
    }

    public static String randomAlphaNumeric(int count) {
        String ALPHA_NUMERIC_STRING = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        StringBuilder builder = new StringBuilder();
        while (count-- != 0) {
            int character = (int)(Math.random()*ALPHA_NUMERIC_STRING.length());
            builder.append(ALPHA_NUMERIC_STRING.charAt(character));
        }
        return builder.toString();
    }

    public static String encryptWithIntegrity(String inputMessage) throws Exception{
        String pubKey = "-----BEGIN PUBLIC KEY-----\n" +
                "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtsyG+dojq+TeX7qVKLzv\n" +
                "jaljEkKFjFZj7+yWs0+XJUcMcCwYdP4TqgU79p4qKwZ4XmazljUbm17Oo9Dm+XAS\n" +
                "YYTpE8f1Nxl8oiWebMrBVcQdf5Q1dcE8uVLbYPggZzOCNR830UMcYHN6S1vwTP+C\n" +
                "WTwVY55pf5k8WK8okYZTDjuZd9KRtkleQkKTsci7ckQ8wjSfFhS4zVou7dV13IpM\n" +
                "2eAojhHmzyIYBJLU23fT+O8AP1/rC8EW5NHui9l5LzkXFBCO+9YfQM2HntXxefN2\n" +
                "xUGoRwhAHnf6D6kaIE2v+I8KvSbwR2LSgqJmDfPVpj4Ff8XqkIjX3yqKlFF1uB5K\n" +
                "/QIDAQAB\n" +
                "-----END PUBLIC KEY-----";
//        Random rand = new SecureRandom();
//        byte[] bytesIV = new byte[16];
//        rand.nextBytes(bytesIV);
//        Log.d("DEBUG:encryption:IV", bytesIV.toString());

        String stringIV = "[B@59e376c123abc";
        byte[] bufferedIV = stringIV.getBytes();// Init Vector (IV)

//        SecureRandom random = new SecureRandom();
//        byte[] salt = new byte[16];
//        random.nextBytes(salt);         // Salt
//
//        KeySpec spec = new PBEKeySpec("12345678".toCharArray(), salt, 65536, 256);
//        SecretKeyFactory f = SecretKeyFactory.getInstance("PBKDF2WithHmacSHA1");
//        byte[] key = f.generateSecret(spec).getEncoded();       // Key

        String key = CryptoRSA.randomAlphaNumeric(32);
        byte[] bufferedKey = key.getBytes();

        // CipherKey Process
        Log.d("DEBUG:encryption", "Encrypt Key Started");
        Cipher cipherRSA = Cipher.getInstance("RSA/ECB/PKCS1Padding");
        cipherRSA.init(Cipher.ENCRYPT_MODE, getPublicKeyFromString(pubKey));
        cipherRSA.update(bufferedKey);
        byte[] cipherKey = cipherRSA.doFinal();
        String cipherKeyString = Base64.getEncoder().encodeToString(cipherKey);
        Log.d("DEBUG:encryption", "Encrypt Key Ended");
        Log.d("DEBUG:encryption:cipherKey", cipherKeyString);

        //CipherText Process
        byte[] input = inputMessage.getBytes();
        SecretKeySpec keySpec = new SecretKeySpec(bufferedKey, "AES");
        IvParameterSpec iv = new IvParameterSpec(bufferedIV);
        Log.d("DEBUG:encryption", "Encrypt Message Started");
        Cipher cipherAES = Cipher.getInstance("AES/CBC/PKCS5PADDING");
        cipherAES.init(Cipher.ENCRYPT_MODE, keySpec, iv);
        byte[] cipherText = cipherAES.doFinal(input);
        String cipherTextString =  Base64.getEncoder().encodeToString(cipherText);
        Log.d("DEBUG:encryption","Encrypt Message Ended");
        Log.d("DEBUG:encryption:cipherText", cipherTextString);

        //Digest Message Process
        MessageDigest digest = MessageDigest.getInstance("SHA-256");
        byte[] hash = digest.digest(inputMessage.getBytes(StandardCharsets.UTF_8));
        String hashMessage = Base64.getEncoder().encodeToString(hash);
        Log.d("DEBUG:encryption:digestMessage",hashMessage);

        return cipherKeyString.concat(cipherTextString).concat(hashMessage);
    }

    public static String encrypt(String inputMessage) throws Exception {
        byte[] input = inputMessage.getBytes();
        String pubKey2 = "-----BEGIN PUBLIC KEY-----\n" +
                "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtsyG+dojq+TeX7qVKLzv\n" +
                "jaljEkKFjFZj7+yWs0+XJUcMcCwYdP4TqgU79p4qKwZ4XmazljUbm17Oo9Dm+XAS\n" +
                "YYTpE8f1Nxl8oiWebMrBVcQdf5Q1dcE8uVLbYPggZzOCNR830UMcYHN6S1vwTP+C\n" +
                "WTwVY55pf5k8WK8okYZTDjuZd9KRtkleQkKTsci7ckQ8wjSfFhS4zVou7dV13IpM\n" +
                "2eAojhHmzyIYBJLU23fT+O8AP1/rC8EW5NHui9l5LzkXFBCO+9YfQM2HntXxefN2\n" +
                "xUGoRwhAHnf6D6kaIE2v+I8KvSbwR2LSgqJmDfPVpj4Ff8XqkIjX3yqKlFF1uB5K\n" +
                "/QIDAQAB\n" +
                "-----END PUBLIC KEY-----";

        String pubKeyTest = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAncR+2HsKjKexfZd66GXPbQ8kVi63WvmHa6fAeN6rzSnGTht+ch/ZCrQ8cB2ojFrQMqZI6F2pkw8diVeZ63TrsZH8ylIkn9kxtl7sBbAIRdwU3ZWoEMEZnAUO2XRoaUbIFVTk7CIXlBypKSa9Vqn08uA4I/Fm8HsOkvkRUETQMRiONTIk2ad2j3bAY5J3ngCSS2CCi+CWdQxN1qPrg3aHczO85KSIestJf3sq8i12UstGZrnTBTPtol8+n8dxb7NPYTTkaK7rPU3WsMIKd8qornbFxEYNKNkkIbr+qwSu21eQ6lcsF1R5gV55ZPX6p7uSGA/d6FWD0m623UHGwmDCoQIDAQAB";

//        KeyPairGenerator keyPairGen = KeyPairGenerator.getInstance("RSA");
//        keyPairGen.initialize(2048);
//        KeyPair pair = keyPairGen.generateKeyPair();
//        PublicKey pubKey = pair.getPublic();
//        PrivateKey privKey = pair.getPrivate();
//
//        byte[] pubKeyByte = pubKey.getEncoded();
//        byte[] privKeyByte = privKey.getEncoded();

//        String publicKeyString = Base64.getEncoder().encodeToString(pubKeyByte);
//        Log.d("DEBUG:generatedPubKey", publicKeyString);
//        String privateKeyString = Base64.getEncoder().encodeToString(privKeyByte);
//        Log.d("DEBUG:generatedPrivKey", privateKeyString);

//        String outputExternal = "BQFwPjRnZjwyi0/naiJ08xCQ0UVeIueluzG/onhPMp+hBFtcieYdn29Qh12v6Lpf6mluxBIGTTZjqZzt/b/IY2ZZxqjlYHgdDnqmi5Wo0fwNPZilZ7PHTLI4hTDuULYNNLZ4e58vq8g/7Ig+B0h1YQ2dys4B1Cp/pGK9th4HtmGKsKCEictZygVWwKX0J+TxBDMathJI3kt2VRUoP4xeyXyV2ifnoWB4cV6kK9yBMJJ6XrJ6KZEGiZBq0bgcoENTyxGsPWJCqxQvNrKxv+Sy8Shh/3tNNbi7VD54m6nYeq30qzpI6mRQfQoQAw06TGq7G+mwrO6A4Vgev93CE/96cw==";
//        byte[] outputExternalByte = Base64.getDecoder().decode(outputExternal);

        Log.d("DEBUG:encryption", "Encryption Started");
        Cipher cipher = Cipher.getInstance("RSA/ECB/PKCS1Padding");
        cipher.init(Cipher.ENCRYPT_MODE, getPublicKeyFromString(pubKeyTest));
        cipher.update(input);
        byte[] cipherText = cipher.doFinal();
        Log.d("DEBUG:encryption", "Encryption Ended");
        Log.d("DEBUG:encryption:output", Base64.getEncoder().encodeToString(cipherText));

//        Cipher cipher1 = Cipher.getInstance("RSA/ECB/PKCS1Padding");
//        cipher1.init(Cipher.DECRYPT_MODE, getPrivateKeyFromString(privKey2));
//        cipher1.update(cipherText);
//        byte[] decryptedText = cipher1.doFinal();
//        String decryptedTextString = new String(decryptedText, StandardCharsets.UTF_8);
//        Log.d("DEBUG:decryptedText", decryptedTextString);

        return Base64.getEncoder().encodeToString(cipherText);
    }
}
