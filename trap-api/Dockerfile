FROM maven:3-jdk-8-alpine as build-stage
COPY . /app
WORKDIR /app
RUN mvn package

FROM openjdk:8-jre-alpine
COPY --from=build-stage /app/target/*.jar /app/app.jar
WORKDIR /app
ENTRYPOINT java -jar app.jar
