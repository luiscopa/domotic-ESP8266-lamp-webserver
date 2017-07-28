

#include <ESP8266WiFi.h>

const char* ssid     = "ciscosb1";
const char* password = "681D8E3D1F";

const char* host = "192.168.1.101";


void setup() {
  Serial.begin(115200);
  delay(10);

  // Nos conectamos a nuestro wifi
  pinMode(2,OUTPUT);
  digitalWrite(2, LOW);
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

int value = 0;

void loop() {
  delay(2000);
  ++value;

  Serial.print("connecting to ");
  Serial.println(host);

  // Creamos una instancia de WIFICLIENT 
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }

  // Creamos la direcciÃ³n para luego usarla en el String del POST que tendremos que enviar
  String url = "http://192.168.0.101/asd/upsa/acciones.php?op=getEstados";
  // creo un string con los datos que enviarÃ© por POST lo creo de antemano para luego poder calcular el tamaÃ±o del string dato que necesitare para enviar por post
  String data = "id=1&Tipo=Foco1&Descripcion=sala&Estado=1";

  //imprimo la url a donde enviaremos la solicitud, solo para debug
  Serial.print("Requesting URL: ");
  Serial.println(url);
 
  

  // Esta es la solicitud del tipoPOST que enviaremos al servidor
  client.print(String("POST ") + url + " HTTP/1.0\r\n" +
               "Host: " + host + "\r\n" +
               "Accept: *" + "/" + "*\r\n" +
               "Content-Length: " + data.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded\r\n" +
               "\r\n" + data);
               
 //String url2 = "http://192.168.0.26/insertar1.php";
  //client.print(String("POST ") + url2 + " HTTP/1.0\r\n" +
    //           "Host: " + host + "\r\n" +
    //           "Accept: *" + "/" + "*\r\n" +
    //           "Content-Length: " + data.length() + "\r\n" +
    //           "Content-Type: application/x-www-form-urlencoded\r\n" +
    //           "\r\n" + data);
//String data2  = String(client.read());
//Serial.println(data2);
  delay(10);

  // Leemos todas las lineas que nos responde el servidor y las imprimimos por pantalla, esto no es necesario  pero es fundamental ver quÃ¨ me respo +-*nde el servidor para localizar fallas en la solicitud post que estoy enviando, 
  Serial.println("Respond:");
  while(client.available()){
    String line = client.readStringUntil('\r');
     
    //int val;
    
    //creo que aki
      if ( line.indexOf("iDispositivo_id = 3 - iEstado_fl = 1") != -1)
       { 
        
        Serial.println("se verifico la base con el esp Estado 1");
        digitalWrite(2, HIGH);
       }
      else if (line.indexOf("iDispositivo_id = 3 - iEstado_fl = 0") != -1)
        {
        Serial.println("se verifico la base con el esp Estado 0"); 
        digitalWrite(2, LOW);
        }

    Serial.print(line);
  }

  Serial.println();

  // se cierra la conexiÃ³n

  Serial.println("closing connection");

}
