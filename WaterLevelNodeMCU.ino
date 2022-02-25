#include<ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <TimedAction.h>
#define echoPin 5//d1
#define trigPin 2//d4
#define In 13//d7
#define red 12 //d6
#define green 14//d5
#define blue 4//d2
const int period=5000;
int level=0;

const String host = "sagarbisht.com";
 int httpPort=443;
 HTTPClient http;
long duration; // variable for the duration of sound wave travel
int distance; // variable for the distance measurement
void RGB_color(int red_light_value, int green_light_value, int blue_light_value)
 {
  analogWrite(red, red_light_value);
  analogWrite(green, green_light_value);
  analogWrite(blue, blue_light_value);
}
void fireData(){
  //  Serial.println(" cm");
  digitalWrite(In,HIGH);
  RGB_color(0, 0, 255);
   WiFiClientSecure clients;
  clients.setInsecure();
 String url="https://www.sagarbisht.com/WaterLevelMonitor/api/fireData.php?PumpState=1&SystemState=1&WaterLevel="+(String)level;
     http.begin(clients,host,httpPort, url);
    int httpResponseCode = http.GET();
    // testingg...
    if(httpResponseCode==200){
    Serial.println("server Responsed");
    
  }else{
    Serial.println("Something Wrong");
     
  }
}
TimedAction numberThread = TimedAction(5000,fireData);
//TimedAction timedAction = TimedAction(5000,fireData);
void setup() {
  // wifi setup
   WiFi.begin("JioFi3_9C76BB","6amb12aap4");
  while( WiFi.status()!=WL_CONNECTED){
    Serial.print("--");
    delay(200);
  }
  Serial.println();
  Serial.print("Connected to :- ");
  Serial.println(WiFi.localIP());
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an OUTPUT
  pinMode(echoPin, INPUT);
  pinMode(In, OUTPUT);
  pinMode(red, OUTPUT);
  pinMode(green, OUTPUT);
  pinMode(blue, OUTPUT);
 // digitalWrite(In,HIGH);// Sets the echoPin as an INPUT
  Serial.begin(9600); // // Serial Communication is starting with 9600 of baudrate speed
//   timerOne.set(period, fireData);
}
void loop() {
 numberThread.check();
  // Clears the trigPin condition
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
 digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  distance = duration * 0.034 / 2;
  if(distance<=4){
 
    RGB_color(255, 0, 0);
    digitalWrite(In,HIGH);
  }else{
     RGB_color(0,255,0);
    digitalWrite(In,LOW);
  }
  Serial.print("Distance: ");
  Serial.println(distance);

level=map(distance,0,980,0,100);
 
  
  //timedAction.check();
  delay(1000);
}
