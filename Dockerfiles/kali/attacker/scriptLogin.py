import os
import requests

# URL di login
url_login = 'https://192.168.2.1/api/loginform'

# Credenziali di login
username = 'utente_0'
password = 'password123'

# Dati di login
payload = {
    'username': username,
    'password': password
}

# Inizializza una sessione
session = requests.Session()

# Effettua il login
response = session.post(url_login, data=payload, verify=False)

# Verifica se il login è stato effettuato con successo
if response.status_code == 200:
    # Estrai i cookie di sessione
    cookies = session.cookies.get_dict()
    # Stampa i cookie nel formato chiave=valore
    for chiave, valore in cookies.items():
        print(f"{chiave}={valore}")
