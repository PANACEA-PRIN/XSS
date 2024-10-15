# XSS
TTP for XSS attack and defense



# TTP Simulator for XSS Attacks with Katharà, Docker, and Caldera

This lab simulates attack and defense techniques for XSS (Cross-Site Scripting) vulnerabilities using **Katharà** for network emulation, **Docker** for managing images, and **Caldera** for simulating TTPs (Tactics, Techniques, and Procedures).

## Requirements

Before starting, ensure you have the following software installed:

- **Katharà**: [Katharà Installation Guide](https://www.kathara.org/)
- **Docker**: [Docker Installation Guide](https://www.docker.com/)
- **OpenSSL**: [OpenSSL Installation Guide](https://openssl.org/)
## Lab Setup

1. **Clone the repository or download the ZIP package:**

   ```bash
   git clone <repository_url>
   ```
2.  **Create self-signed certificates**

    ```bash
    cd /Dockerfile/certificates
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout lab.key -out lab.crt \
    -subj "/C=IT/ST=Lazio/L=Rome/O=MyCompany/OU=IT Department/CN=127.0.0.1"
    ```
    And then copy them inside the directory Website, Polarproxy and Kali

   
3. **Clone the repository of caldera**

   Copy the Dockerfile inside the directory caldera
   Clone the repository inside Dockerfile directory
   ```bash
   git clone https://github.com/mitre/caldera.git --recursive
   ```
   Paste the Dockerfile previosly copied.
   
4. **Build the Docker images:**

   Navigate to the `Dockerfiles` folder and run the build script:

   ```bash
   cd Dockerfiles
   ./docker_image_builder.sh
   ```

   > **Note:** The build process may take a few minutes.

## Starting the Lab

Once the Docker images are built, start the lab:

1. Move to the `kathara_lab` directory:

   ```bash
   cd kathara_lab
   ```

2. Start the lab with the following command:

   ```bash
   kathara lstart
   ```

3. Wait approximately 2 minutes for all terminals to be ready.

4. To clean up and stop the lab, run:

   ```bash
   kathara lclean
   ```

## Accessing the Lab Services

After the lab is fully loaded, you can access the following services:

- **NoVNC Client**: [localhost:8081](http://localhost:8081)  
  Access the client via a graphical interface.

- **Kali NoVNC**: [localhost:8080](http://localhost:8080)  
  Access the Kali Linux machine via a graphical interface.

- **Vulnerable Website HTTPS**: [localhost:8443](https://localhost:8443)  
  Access the vulnerable website via HTTPS.

- **Vulnerable Website HTTP**: [localhost:80](http://localhost:80)  
  Access the vulnerable website via HTTP.

- **Caldera**: [localhost:8888](http://localhost:8888)  
  Access the Caldera interface to start the attack simulations.

## Documentation

The **Implementation PDF** included in the repository is an excerpt from the thesis that details the design and implementation of the lab based on Katharà and Caldera.
