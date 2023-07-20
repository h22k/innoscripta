# Use the latest Node.js version
FROM node:latest

# Set the working directory
WORKDIR /app

# Copy and install necessary dependencies
COPY package.json .
COPY pnpm-lock.yaml .
RUN npm install pnpm -g
RUN pnpm install

# Copy the application
COPY . .

# Start the application
CMD ["pnpm", "dev"]
