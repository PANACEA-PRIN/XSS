import requests
from bs4 import BeautifulSoup
url_login = 'https://192.168.2.1/api/loginform'
url = "https://192.168.2.1/api/createpost"

# Funzione per fare il login
def login_user(session):

    username = 'utente_0'
    password = 'password123'
    payload = {
        'username': username,
        'password': password
    }
    response = session.post(url_login, data=payload, verify=False)
    return response.status_code == 200


def send_payload(url, data,session):
    response = session.post(url, data=data)
    return response

def check_reflection(response, payload):
    if payload in response.text:
        print("[+] Payload riflesso: XSS possibile!")
    else:
        print("[-] Nessun riflesso rilevato.")

def main():
    cert_path = 'attacker/mycert.crt'

    session = requests.Session()

    # Il payload XSS da testare
    
    # Dati da inviare con il POST

    if (login_user(session)):
        # Invia il payload
        with open ("path",'r') as payloadList:
            for payload in payloadList:
                data = {
                    "comment":  payload[:-1]
                }
                response = send_payload(url, data,session)
                
                # Ora recupera la pagina dove ti aspetti di vedere il payload riflesso
                home_url = "http://192.168.2.1/home"
                response_home = requests.get(home_url)

                # Controlla se il payload è stato riflesso nella pagina
                check_reflection(response_home, payload)

if __name__ == "__main__":
    main()
