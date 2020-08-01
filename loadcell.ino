#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include "HX711.h"

#define LOADCELL_DOUT_PIN     D1
#define LOADCELL_SCK_PIN      D2

//각자 수정해야 할 부분
const char* ssid = "공유기 이름";
const char* password = "공유기 비번";
String host = "서버 주소";

const long interval = 5000;
unsigned long previousMillis = 0;
float loadcellValue = 372.0;
int flag = 0;

WiFiServer server(80);
WiFiClient client;
HX711 scale;

void setup() {
  // put your setup code here, to run once:


  Serial.begin(9600);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connecting to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  server.begin();
  Serial.println("Server started");
  
  // 로드셀 HX711 보드 pin 설정
  scale.begin(LOADCELL_DOUT_PIN, LOADCELL_SCK_PIN);

  // 부팅 후 잠시 대기 (2초)
  delay(2000);

  // 측정값 1회 읽어오기
  Serial.print("read: \t\t\t");
  Serial.println(scale.read());

  delay(1000);

  // 스케일 설정
  scale.set_scale(loadcellValue);
  
  // 오프셋 설정(10회 측정 후 평균값 적용) - 저울 위에 아무것도 없는 상태를 0g으로 정하는 기준점 설정(저울 위에 아무것도 올려두지 않은 상태여야 합니다.)   
  scale.tare(10);    

  // 설정된 오프셋 및 스케일 값 확인
  Serial.print("Offset value :\t\t");
  Serial.println(scale.get_offset());
  Serial.print("Scale value :\t\t");
  Serial.println(scale.get_scale());

  // (read - offset) 값 확인 (scale 미적용)
  Serial.print("(read - offset) value: \t");  
  Serial.println(scale.get_value());
  delay(2000);
  

}

void loop() {
  // put your main code here, to run repeatedly:
  HTTPClient http;
  float weight;
  String PostData; 

  //값을 3번은 측정해야 더 정확한 값이 나올 것 같아서 flag 설정함
  while(flag < 3) {
    weight = scale.get_units(5);
    while(weight <= 10) {
      weight = scale.get_units(5);
    }
    flag = flag + 1;
  }

  //flag가 3일 때만 데이터 전송
  if(flag == 3){
    char stringdata[10];

    //float to String 소수점 버림 처리함
    dtostrf(weight, 4, 0, stringdata);
    Serial.printf("%s\n", stringdata);
    PostData = stringdata;

    //POST 전송
    http.begin("http://xayahx.dothome.co.kr/loadcell.php");
    http.addHeader("Content-Type","application/x-www-form-urlencoded");
    int httpCode = http.POST("weight="+PostData);
    String payload = http.getString();
    
    http.setTimeout(1000);
   
    if(httpCode > 0) {
      Serial.printf("POST code : %d\n\n", httpCode);
 
    if(httpCode == HTTP_CODE_OK) {
      Serial.println(payload);
     }
    } 
    else {
    Serial.printf("POST failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
    flag = flag + 1;
  }
}
