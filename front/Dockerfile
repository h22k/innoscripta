# Use the latest Node.js version
FROM node:latest

# Set the working directory
WORKDIR /app

RUN npm install -g pnpm

# Copy and install necessary dependencies
COPY package.json .
COPY pnpm-lock.yaml .
RUN pnpm install

# Copy the application
COPY . .

# Start the application
CMD ["pnpm", "dev", "--host=0.0.0.0" , "--port", "3000"]
