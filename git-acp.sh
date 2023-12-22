#!/bin/bash

# Accept input message
read -p "Enter commit message: " commit_message

# Check if the message is provided
if [ -z "$commit_message" ]; then
    echo "Commit message cannot be empty. Exiting."
    exit 1
fi

# Run git commands
git add .
git commit --allow-empty -m "$commit_message"
git push origin main

# Check if the git commands were successful
if [ $? -eq 0 ]; then
    echo "Git commands executed successfully."
else
    echo "Error executing git commands. Please check your changes and try again."
fi
