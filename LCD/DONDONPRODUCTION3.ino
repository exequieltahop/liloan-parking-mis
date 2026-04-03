#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include "Arduino.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>

#define SDA_PIN D2
#define SCL_PIN D1

LiquidCrystal_I2C lcd(0x27, 16, 4);

const char* ssid = "donix07";
const char* password = "vivoY3507";

// const char* serverName = "https://steelblue-magpie-778031.hostingersite.com/api/get-data";
const char* serverName = "https://blue-fish-443035.hostingersite.com/api/get-data";

WiFiClientSecure client;

void setup() {
  Serial.begin(115200);
  Wire.begin(SDA_PIN, SCL_PIN);
  lcd.init();
  lcd.backlight();

  lcd.setCursor(0, 0);
  lcd.print("Connecting WiFi");

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("WiFi Connected");
  delay(1000);

  client.setInsecure(); // Skip cert verification
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("WiFi Disconnected");
    return;
  }

  HTTPClient https;
  client.setInsecure();  // Ensure insecure mode each loop

  String postData = "data=1";

  if (https.begin(client, serverName)) {
    https.addHeader("Content-Type", "application/x-www-form-urlencoded");
    https.addHeader("Authorization", "Bearer 1|jsXVqrjlLsjOzENSnUewhkl2dTzonVcbGvxExpOf7e9d1f54");
    int httpCode = https.POST(postData);

    if (httpCode > 0) {
      String payload = https.getString();
      Serial.println("Payload received:");
      Serial.println(payload);

      // Split payload by line
      int start = 0;
      int lineCount = 0;
      String lines[10];  // Up to 10 slots

      while (start < payload.length()) {
        int end = payload.indexOf('\n', start);
        if (end == -1) end = payload.length();
        String line = payload.substring(start, end);
        line.trim();

        if (line.length() > 0 && lineCount < 10) {
          lines[lineCount++] = line;
        }
        start = end + 1;
      }

      // Display in pages of 4 lines
      int linesPerPage = 4;

      // header
      lcd.setCursor(0, 10);
      lcd.print("Liloan SeaPort");

      for (int i = 0; i < lineCount; i += linesPerPage) {
        // lcd.clear();
        for (int j = 0; j < linesPerPage && (i + j) < lineCount; j++) {
          // lcd.setCursor(0, j);
          lcd.setCursor(1, j);
          lcd.print(lines[i + j]);
        }
        delay(1000);  // Show each page for 1 second
      }

    } 
    https.end();
  } 
  delay(3000);  // Wait 10 seconds before next request
}
