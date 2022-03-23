# Product data processor
A simple Symfony CLI based application that can read local or remote XML product data files and parse them into a local CSV file.

## Installation
1. Clone the repository in your local system using Git.
2. This repository contains a Dockerfile that can be used to quickly build the docker image in order to set up the project. 
3. Using the below command from the root of the repository.
```bash
docker build -t product-data-processor .
```
4. Spin up a Docker container using the above image that you just built.
```bash
docker run -t -d --name product-data-processor-container product-data-processor:latest
```
5. This will set up the Symfony application ready for running the command. To run the process command, you may use
```bash
docker exec product-data-processor-container php application.php app:process-product-data files/coffee_feed_trimmed.xml
```
where `files/coffee_feed_trimmed.xml` is the relative path of the input file starting from the root of the application. You may also pass it as an absoulte path of a remote URI of an XMl file.
6. Once the command completes successfully, you will be able to see the output in `files/output.csv`

## TODOs for Improvements:
If I could have spent more time on this project, I would have loved to
1. Handle errors gracefully and maintain a log of records.
2. Add more tests specifically for negative scenarios.
3. Use Symfony container for DI
