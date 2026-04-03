#include "Arduino.h"
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>

// Define ultrasonic sensor

// #define TRIG_PIN_SONIC_1 D4
// #define ECHO_PIN_SONIC_1 D3

#define TRIG_PIN_SONIC_1 D5
#define ECHO_PIN_SONIC_1 D6


// is it available if 1 yes else 0 no
int sonic1 = 1;

// Replace with your network credentials
const char* ssid = "donix07";
const char* password = "vivoY3507";

// HTTPS server URL
// const char* serverName = "https://steelblue-magpie-778031.hostingersite.com/api/log-data";
const char* serverName = "https://blue-fish-443035.hostingersite.com/api/log-data";

// Declare WiFiClientSecure for HTTPS
WiFiClientSecure client;

// Create HTTPClient object
HTTPClient https;

// Define distance threshold (in cm)
const long DISTANCE_THRESHOLD = 100;  // Adjust this value based on your parking sensor setup

void setup() {
  Serial.begin(115200);

  pinMode(TRIG_PIN_SONIC_1, OUTPUT);
  pinMode(ECHO_PIN_SONIC_1, INPUT);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());

  // Disable SSL certificate verification (for testing only)
  client.setInsecure();
}

void loop() {
  long distances;

  distances = getDistance(TRIG_PIN_SONIC_1, ECHO_PIN_SONIC_1);

  // Print distances for debug

  Serial.print(distances);
  Serial.println(" cm");

  /*
  EDITA KO
  */
  if (distances < DISTANCE_THRESHOLD) {
    if (sonic1 == 1) {
      /*
      ALISDI AG NUMBER INTO THE SLOT NO FOR EXAMPLE MAG UPLOAD SA NODE NGA PANG PARKING SLOT 7 THEN 7.
      */
      log_data("5", "occupied");

      sonic1 = 0;
    }
  } else {
    if (sonic1 == 0) {

      /*
      ALISDI AG NUMBER INTO THE SLOT NO FOR EXAMPLE MAG UPLOAD SA NODE NGA PANG PARKING SLOT 7 THEN 7. SAME ABOVE
      */
      log_data("5", "not_occupied");

      sonic1 = 1;
    }
  }

  delay(2000);  // Wait 2 seconds before next measurement cycle
}

  // Function to get distance measured by ultrasonic sensor
  long getDistance(uint8_t trigPin, uint8_t echoPin) {
    digitalWrite(trigPin, LOW);
    delayMicroseconds(2);
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);

    long duration = pulseIn(echoPin, HIGH, 30000);  // timeout 30 ms to avoid blocking long

    if (duration == 0) {
      return -1;  // No echo received within timeout
    }

    // Calculate distance in cm; speed of sound = 343 m/s = 0.0343 cm/us
    long distance = (duration * 0.0343) / 2;
    return distance;
  }

   // Post data with slot_no and status as form parameters
  void log_data(String slot_no, String status) {

    https.begin(client, String(serverName) + "/"+ slot_no + "/" + status);
    https.addHeader("Authorization", "Bearer 1|jsXVqrjlLsjOzENSnUewhkl2dTzonVcbGvxExpOf7e9d1f54");

    int httpCode = https.POST("");

    if (httpCode > 0) {
      Serial.printf("Sensor %s POST Response code: %d\n", slot_no.c_str(), httpCode);
      String payload = https.getString();
      Serial.println("Response Payload:");
      Serial.println(payload);
    } else {
      Serial.printf("Sensor %s HTTPS POST failed, error code: %d\n", slot_no.c_str(), httpCode);
    }

    https.end();
  }