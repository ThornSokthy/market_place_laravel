FROM ubuntu:latest
LABEL authors="PNY"

ENTRYPOINT ["top", "-b"]
