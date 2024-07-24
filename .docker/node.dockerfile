FROM node:18-alpine

RUN mkdir -p /app

WORKDIR /app

COPY frontend/package.json /app/package.json

RUN npm install

CMD ["npm", "start"]
