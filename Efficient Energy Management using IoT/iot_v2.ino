/**
   BasicHTTPClient.ino

    Created on: 24.05.2015

*/

#include <Arduino.h>
#include <Servo.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>
Servo servo_1;
ESP8266WiFiMulti WiFiMulti;
const char* server="http://iot100.000webhostapp.com/i%20t/update_energy.php";
unsigned long int t1,t2;
unsigned int angle=0;
String payload="hello";
String payload1="0000";
void setup() {
  t1=millis();
  t2=millis();
 servo_1.attach(0);
  Serial.begin(115200);
  // Serial.setDebugOutput(true);
 pinMode(LED_BUILTIN,OUTPUT);
  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP("mi", "");
servo_1.write(angle);
delay(2000);
l_ed();
u_pdate(); 
s_ervo(); 
}

void loop() {
  
  // wait for WiFi connection
  if ((WiFiMulti.run() == WL_CONNECTED)) {
 l_ed();  
  }
  delay(3000);
 if ((WiFiMulti.run() == WL_CONNECTED) and (millis()-t1)>20000) {
  u_pdate();
  t1=millis();
}
if ((WiFiMulti.run() == WL_CONNECTED) and (millis()-t2)>20000) {
  
   s_ervo();
   t2=millis(); 
}
}
void s_ervo()
{
    WiFiClient client;

    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    if (http.begin(client, "http://iot100.000webhostapp.com/i%20t/sangle1.php")) {  // HTTP
      Serial.print("[HTTP] GET...\n");
      // start connection and send HTTP header
      int httpCode = http.GET();
      // httpCode will be negative on error
      if (httpCode > 0) {
        // HTTP header has been send and Server response header has been handled
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);
        // file found at server
        if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
           payload1 = http.getString();
          Serial.println(payload1);
     angle=payload1.toInt();
     servo_1.write(angle);
        }
        
      } 
      else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
}
void u_pdate()
{
  
    WiFiClient client;

    HTTPClient http;
    float v,c;
    v=analogRead(A0);
    v=v*3.3/1024;
    v=v*157/47;
    c=v*1000/157;
  http.begin(server);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  String hr="ic="+String(c)+"&iv="+String(v)+"&oc="+String(c)+"&ov="+String(v);
  int hrr=http.POST(hr);
  Serial.print("HTTP Response code: ");
      Serial.println(hrr);
        
      // Free resources
      http.end();
}
void l_ed()
{
  WiFiClient client;

    HTTPClient http;

    Serial.print("[HTTP] begin...\n");
    if (http.begin(client, "http://iot100.000webhostapp.com/i%20t/ledstatus.php")) {  // HTTP


      Serial.print("[HTTP] GET...\n");
      // start connection and send HTTP header
      int httpCode = http.GET();

      // httpCode will be negative on error
      if (httpCode > 0) {
        // HTTP header has been send and Server response header has been handled
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);

        // file found at server
        if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
           payload = http.getString();
          Serial.println(payload);
     if(payload[1]=='1')
    {
      digitalWrite(LED_BUILTIN,0);
    }
    if(payload[1]=='0')
    {
      digitalWrite(LED_BUILTIN,1);
    }
    if(payload[3]=='1')
    {
      digitalWrite(D1,0);
    }
    if(payload[3]=='0')
    {
      digitalWrite(D1,1);
    }
        }
        
      } 
      else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }

      http.end();
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
}
