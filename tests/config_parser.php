<?php

use OpenBlu\Utilities\OpenVPNConfiguration;

include_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'OpenBlu' . DIRECTORY_SEPARATOR . 'Utilities' . DIRECTORY_SEPARATOR . 'OpenVPNConfiguration.php');

// Sample data for parsing
$sample = "client
dev tun
remote example.com
resolv-retry infinite
#comment here
nobind
persist-key
persist-tun
ca [inline]
cert [inline]
key [inline]
tls-auth [inline] 1
verb 1 ; this is also a comment!
keepalive 10 120
port 1194
proto udp
cipher BF-CBC
comp-lzo
remote-cert-tls server
<ca>
-----BEGIN CERTIFICATE-----
MIIE1jCCA76gAwIBAgIJAOMAQRbD8ADYMA0GCSqGSIb3DQEBCwUAMIGiMQswCQYD
VQQGEwJCUjELMAkGA1UECBMCU1AxETAPBgNVBAcTCFNhb1BhdWxvMRMwEQYDVQQK
EwpFeGFtcGxlQ29tMQ0wCwYDVQQLEwRBQ01FMRYwFAYDVQQDEw1FeGFtcGxlQ29t
IENBMRAwDgYDVQQpEwdFYXN5UlNBMSUwIwYJKoZIhvcNAQkBFhZwb3N0bWFzdGVy
QGV4YW1wbGUuY29tMB4XDTE0MTIyODE2NTg1MVoXDTI0MTIyNTE2NTg1MVowgaIx
CzAJBgNVBAYTAkJSMQswCQYDVQQIEwJTUDERMA8GA1UEBxMIU2FvUGF1bG8xEzAR
BgNVBAoTCkV4YW1wbGVDb20xDTALBgNVBAsTBEFDTUUxFjAUBgNVBAMTDUV4YW1w
bGVDb20gQ0ExEDAOBgNVBCkTB0Vhc3lSU0ExJTAjBgkqhkiG9w0BCQEWFnBvc3Rt
YXN0ZXJAZXhhbXBsZS5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIB
AQDN2iT4+3BgxWjxm3uiFSoLpGoi6Elevywwx4EsvGdqWBNkANGH4wZdHrf+nCgB
yofybvFXKKPMioPrh08aBOTXTyM5tZvjgcRKrWd/9oL5VrqaDym4ugFEHjugBy7J
lXQfLIfIxwlZXKVMjMg2iBC/9H3H6fO2zthqkrLB0VPeAwvuUPkBxWfIps4MsjDm
bBinYHzxwJwPOsFdYnqqcOVRF9v3mt+PbFk+M5fW3UY63KE5Ry2FohsaiiAJ/JMc
gFEJuNDmoMl/ozPeOY5ZNS3ARMBisHSx69tDip1mPQYGNG5yuy5TFI1pKzkEFV+9
lXEgJFOfefyTdszmFWHLC14vAgMBAAGjggELMIIBBzAdBgNVHQ4EFgQUZtPpYH36
aVdAP/6N8Eue14SG7HAwgdcGA1UdIwSBzzCBzIAUZtPpYH36aVdAP/6N8Eue14SG
7HChgaikgaUwgaIxCzAJBgNVBAYTAkJSMQswCQYDVQQIEwJTUDERMA8GA1UEBxMI
U2FvUGF1bG8xEzARBgNVBAoTCkV4YW1wbGVDb20xDTALBgNVBAsTBEFDTUUxFjAU
BgNVBAMTDUV4YW1wbGVDb20gQ0ExEDAOBgNVBCkTB0Vhc3lSU0ExJTAjBgkqhkiG
9w0BCQEWFnBvc3RtYXN0ZXJAZXhhbXBsZS5jb22CCQDjAEEWw/AA2DAMBgNVHRME
BTADAQH/MA0GCSqGSIb3DQEBCwUAA4IBAQAzoAlU1DoAw0pkHMwgsfWvg6JQsIOL
dNjB3bS5t5fo+tiRjSBPVOkPUzfWMyqpOp19+Y/MWQ5ZSJ5uGsVz5Bas5iqLMDXU
SouqdfT1l5rT+cD6hXrro2OsDHHajCrR4Vz/g36wMQ5f9403EjxBdWVs/Ul5n++2
E59a08pSBv40DNiqQXDdSWt1cHsA/m7sX7pDatqNEIYg11tgO5sixpdCCz9OakLp
r5IO4jodz6OvT3nZ7gH84UfeNXBUjO/BNYhyGGge9TmpRhRM9q8CNpw4LtQFuO4/
xcPC3D4Gk0EW83PJorGi1+lPGNusEDO0xqlv2pLyQ07XVKWsYZo3AKQY
-----END CERTIFICATE-----
</ca>
<cert>
Certificate:
    Data:
        Version: 3 (0x2)
        Serial Number: 2 (0x2)
    Signature Algorithm: sha256WithRSAEncryption
        Issuer: C=BR, ST=SP, L=SaoPaulo, O=ExampleCom, OU=ACME, CN=ExampleCom CA/name=EasyRSA/emailAddress=postmaster@example.com
        Validity
            Not Before: Dec 28 17:27:58 2014 GMT
            Not After : Dec 25 17:27:58 2024 GMT
        Subject: C=BR, ST=SP, L=SaoPaulo, O=ExampleCom, OU=ACME, CN=example-client/name=EasyRSA/emailAddress=postmaster@example.com
        Subject Public Key Info:
            Public Key Algorithm: rsaEncryption
                Public-Key: (2048 bit)
                Modulus:
                    00:e7:cf:44:c2:68:55:35:0f:2e:2c:c7:b9:66:23:
                    38:87:91:9d:65:30:67:08:c1:11:bd:82:2a:b1:50:
                    04:df:c6:a9:89:7a:b8:9f:6d:a0:5c:21:91:03:29:
                    b0:48:77:70:02:73:79:2b:88:99:12:29:81:75:1f:
                    69:d3:d1:eb:24:a3:f9:9f:58:05:b6:66:0c:67:f2:
                    53:51:d3:d3:d6:31:dd:0f:3b:32:71:8f:63:ab:6e:
                    4e:e3:59:86:3b:71:60:ac:bc:37:78:eb:e5:d4:f6:
                    56:ef:b8:cc:d5:20:95:6f:09:30:dd:cf:24:3c:97:
                    a9:a5:d8:b4:f2:9a:ce:af:b3:66:08:e1:ba:63:0a:
                    96:e9:5c:ed:68:d0:88:16:a7:fa:1c:a6:88:5b:9c:
                    db:ea:4d:d5:bb:a8:c2:e3:2b:03:5a:c8:dd:76:c9:
                    c0:a0:4d:b7:09:c6:e1:72:35:3e:81:f4:9f:df:09:
                    10:a8:09:d5:73:05:6e:61:53:5f:31:1e:96:4f:d5:
                    db:b7:00:d2:05:40:ba:46:5e:61:b9:9c:a5:a6:fb:
                    f8:a4:58:4f:6d:5d:91:6e:e4:fb:f9:a6:70:2f:1c:
                    63:a6:e1:cc:fa:26:9c:ff:6a:ce:f6:31:dc:e5:55:
                    66:09:b1:67:e7:f5:eb:8e:e0:21:bc:85:da:43:30:
                    d5:1f
                Exponent: 65537 (0x10001)
        X509v3 extensions:
            X509v3 Basic Constraints: 
                CA:FALSE
            Netscape Comment: 
                Easy-RSA Generated Certificate
            X509v3 Subject Key Identifier: 
                3B:77:AC:80:01:C4:54:CC:68:F7:54:A4:54:EB:1E:29:67:EA:3F:B5
            X509v3 Authority Key Identifier: 
                keyid:66:D3:E9:60:7D:FA:69:57:40:3F:FE:8D:F0:4B:9E:D7:84:86:EC:70
                DirName:/C=BR/ST=SP/L=SaoPaulo/O=ExampleCom/OU=ACME/CN=ExampleCom CA/name=EasyRSA/emailAddress=postmaster@example.com
                serial:E3:00:41:16:C3:F0:00:D8

            X509v3 Extended Key Usage: 
                TLS Web Client Authentication
            X509v3 Key Usage: 
                Digital Signature
    Signature Algorithm: sha256WithRSAEncryption
        8c:42:68:7e:39:dd:9d:af:2c:5a:4b:08:ff:e8:8f:0b:75:bc:
        4a:19:a2:73:33:1f:b4:2e:60:22:bb:07:b5:5b:5a:0e:86:1f:
        da:02:09:98:29:70:87:7f:25:fd:53:8d:65:21:6f:36:90:8c:
        69:1a:b0:be:b6:52:b7:60:3e:75:e8:0a:a9:21:f1:d5:11:ce:
        fd:53:01:de:c8:e6:97:e4:32:b5:e9:af:04:83:d0:02:5e:48:
        53:b9:ee:52:bb:55:78:fd:24:29:a9:4a:f0:38:fa:39:3f:5d:
        12:b7:81:bb:ba:64:7c:1e:76:02:25:80:f8:6f:d2:c4:f0:76:
        bc:72:f7:93:3c:2f:1d:43:19:ed:4c:f2:1b:a9:7b:96:bf:01:
        12:3b:7a:31:2b:8a:0e:2e:aa:e7:3e:1d:5e:43:4a:79:ca:16:
        9a:5d:79:6f:1f:fc:b4:85:56:a6:c5:36:7d:c2:91:7d:9e:be:
        0d:e4:5b:ad:34:a8:f0:2e:71:8b:aa:ac:ee:41:c4:41:1f:9c:
        1a:93:f7:f7:f6:d2:6c:c4:a1:0b:dc:e9:0c:96:57:1a:90:4d:
        1f:49:a3:3e:5e:5c:8f:ac:0c:37:b3:d2:6b:8c:85:43:f2:e5:
        4e:5d:f6:3c:a2:5e:9c:b1:35:71:58:e8:54:73:d1:1d:4b:dc:
        41:d7:57:fb
-----BEGIN CERTIFICATE-----
MIIFHTCCBAWgAwIBAgIBAjANBgkqhkiG9w0BAQsFADCBojELMAkGA1UEBhMCQlIx
CzAJBgNVBAgTAlNQMREwDwYDVQQHEwhTYW9QYXVsbzETMBEGA1UEChMKRXhhbXBs
ZUNvbTENMAsGA1UECxMEQUNNRTEWMBQGA1UEAxMNRXhhbXBsZUNvbSBDQTEQMA4G
A1UEKRMHRWFzeVJTQTElMCMGCSqGSIb3DQEJARYWcG9zdG1hc3RlckBleGFtcGxl
LmNvbTAeFw0xNDEyMjgxNzI3NThaFw0yNDEyMjUxNzI3NThaMIGjMQswCQYDVQQG
EwJCUjELMAkGA1UECBMCU1AxETAPBgNVBAcTCFNhb1BhdWxvMRMwEQYDVQQKEwpF
eGFtcGxlQ29tMQ0wCwYDVQQLEwRBQ01FMRcwFQYDVQQDEw5leGFtcGxlLWNsaWVu
dDEQMA4GA1UEKRMHRWFzeVJTQTElMCMGCSqGSIb3DQEJARYWcG9zdG1hc3RlckBl
eGFtcGxlLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAOfPRMJo
VTUPLizHuWYjOIeRnWUwZwjBEb2CKrFQBN/GqYl6uJ9toFwhkQMpsEh3cAJzeSuI
mRIpgXUfadPR6ySj+Z9YBbZmDGfyU1HT09Yx3Q87MnGPY6tuTuNZhjtxYKy8N3jr
5dT2Vu+4zNUglW8JMN3PJDyXqaXYtPKazq+zZgjhumMKlulc7WjQiBan+hymiFuc
2+pN1buowuMrA1rI3XbJwKBNtwnG4XI1PoH0n98JEKgJ1XMFbmFTXzEelk/V27cA
0gVAukZeYbmcpab7+KRYT21dkW7k+/mmcC8cY6bhzPomnP9qzvYx3OVVZgmxZ+f1
647gIbyF2kMw1R8CAwEAAaOCAVkwggFVMAkGA1UdEwQCMAAwLQYJYIZIAYb4QgEN
BCAWHkVhc3ktUlNBIEdlbmVyYXRlZCBDZXJ0aWZpY2F0ZTAdBgNVHQ4EFgQUO3es
gAHEVMxo91SkVOseKWfqP7UwgdcGA1UdIwSBzzCBzIAUZtPpYH36aVdAP/6N8Eue
14SG7HChgaikgaUwgaIxCzAJBgNVBAYTAkJSMQswCQYDVQQIEwJTUDERMA8GA1UE
BxMIU2FvUGF1bG8xEzARBgNVBAoTCkV4YW1wbGVDb20xDTALBgNVBAsTBEFDTUUx
FjAUBgNVBAMTDUV4YW1wbGVDb20gQ0ExEDAOBgNVBCkTB0Vhc3lSU0ExJTAjBgkq
hkiG9w0BCQEWFnBvc3RtYXN0ZXJAZXhhbXBsZS5jb22CCQDjAEEWw/AA2DATBgNV
HSUEDDAKBggrBgEFBQcDAjALBgNVHQ8EBAMCB4AwDQYJKoZIhvcNAQELBQADggEB
AIxCaH453Z2vLFpLCP/ojwt1vEoZonMzH7QuYCK7B7VbWg6GH9oCCZgpcId/Jf1T
jWUhbzaQjGkasL62UrdgPnXoCqkh8dURzv1TAd7I5pfkMrXprwSD0AJeSFO57lK7
VXj9JCmpSvA4+jk/XRK3gbu6ZHwedgIlgPhv0sTwdrxy95M8Lx1DGe1M8hupe5a/
ARI7ejErig4uquc+HV5DSnnKFppdeW8f/LSFVqbFNn3CkX2evg3kW600qPAucYuq
rO5BxEEfnBqT9/f20mzEoQvc6QyWVxqQTR9Joz5eXI+sDDez0muMhUPy5U5d9jyi
XpyxNXFY6FRz0R1L3EHXV/s=
-----END CERTIFICATE-----
</cert>
<key>
-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDnz0TCaFU1Dy4s
x7lmIziHkZ1lMGcIwRG9giqxUATfxqmJerifbaBcIZEDKbBId3ACc3kriJkSKYF1
H2nT0esko/mfWAW2Zgxn8lNR09PWMd0POzJxj2Orbk7jWYY7cWCsvDd46+XU9lbv
uMzVIJVvCTDdzyQ8l6ml2LTyms6vs2YI4bpjCpbpXO1o0IgWp/ocpohbnNvqTdW7
qMLjKwNayN12ycCgTbcJxuFyNT6B9J/fCRCoCdVzBW5hU18xHpZP1du3ANIFQLpG
XmG5nKWm+/ikWE9tXZFu5Pv5pnAvHGOm4cz6Jpz/as72MdzlVWYJsWfn9euO4CG8
hdpDMNUfAgMBAAECggEBANSM3INVnytzq+crivf4O5EzF5r88ry4K0gU3oiO0qlN
Q47nk/m7T1qq/Ihl5VnNCkt1Dhm4uoJIxIdcMnEi/fUu1WgiEbrZf26gZ32UOZ0h
Q4z/vpUZ4U4DaxpTsB05LGe2fTbHNoo7BiPw0wBpTBvv1XrMwHE+rzN+rQv2nqXC
nhbPb9uCxVdS6MZtc/A0WTbu8DEAyvhw4ncIADrF3xpfBr8L0+qC1NMgJvjZQPDT
9WY3/93emMaMhlESLsK0m+HEmolFUiXMJKNSG8oi4yRb2VMDcc6pMrnkNE9Uq/4T
dTeJ2Jx/3hJHvBUC//vApgO46I170sOCBqddCj41zIECgYEA/ncsdacG+KT63YTT
Dnl5bPeya+r+3oKeIcq6PWH5VdWPB6IaOlBnp4zMl+DnucTz+Uwib/l4w0hALP84
6BedeuyqmiYI5tyeDAm762M9NqvQoL1LAlgG807LtpXQzgyuM8SKarr6mtnA9oX1
tWsE7waTXik2j1RpKwe68BcybhECgYEA6TUezmRy2vCGh0VZq9wGr/7MlK2eOoHT
v5AqQHHQhY8vgQLfH5CSpl+yqDTbX5S/u9ki0rAbXFbze5HiBxagjYPIUUUJUcfV
4IaYjGdih4othHOMREOxXqLfUue1AOtXOCuNLhwZtoMWyuexbEaX9Z8t3hgW5X4l
d3VnNCXkoC8CgYEAzTlh8vUlSy0LYdJ4wUi45GgUTrL0oJHpZMlyUIUOqOoWc4qJ
6pPkNR3591ecq5crSNjdQT+K5LwFfgTMaWp6SKRMpwubzE0Lbhv/ocSkns4M8UYZ
E6fY2yumYfgLsdJKQFf3ZkKsUGzkEi5RzuGj1f6QpbVJWmkydFDEtFORCXECgYAW
FV+rb7uom+pBWQHa0mUXuWsqER7Qr4abt00o+R4j56E5+EmktY4NjzZd01OKw408
fp1bki2lGt7HrtLWlP/zJq2LdJwjUGcicdx0Pz4HU8BnsIFx3W8oZQf809BCHAcQ
XJ9r5GFS9SrtX+9fL3goXEB9rY5NgRqPK2DwgT4bJQKBgHA0f7eJ7KF25DWlU/so
E5U508g+03P19bKX/ZdjK7QLWv8HvW4wMprC+Fv2Kc1Dc/HZ0BO5nQOAJHFp0a33
I0arr3xVhS/+VC2DwFQSScWp+uSAT32SG/NihcwUfxEf8F9vKsrIVtE8hZGdPCKe
1izxoc0xwmCSz9QWDkW3ax17
-----END PRIVATE KEY-----
</key>
<tls-auth>
#
# 2048 bit OpenVPN static key
#
-----BEGIN OpenVPN Static key V1-----
073b0025464cdeaa6189247397d0f2f6
4c2cb415f7b662af421d3ea7c9d50c10
61ebd5ed93d04c2f863b4a6cc4ce6b32
b981297a1eb35d83e75b3051b162c286
653032398c3bc539bec746c778d67c16
dad74a45ce4e85e57bb04b3675f43ecc
e020210c3d252957e86b087804338c3a
2cec5f08306d276a54558cff885a7296
330ce026485ae88a0099430002a570f1
20b774bf64501ae28ed6650a2bc463ce
032a4c9495dd2849550ad09af18cb953
8aa516354e7a6f302fb7d9f66d1dad7f
9fe7683d84dd90d0985dff7dc2881b24
87884d98ffaafecff27d10d554e2f5a7
78226ee0561cb8f815a10b132b097579
9a9a92359aa0574a95715a1df0e51484
-----END OpenVPN Static key V1-----
</tls-auth>
";

$Configuration = OpenVPNConfiguration::parseConfiguration($sample);
var_dump($Configuration);