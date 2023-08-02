pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Checkout your code from version control
                checkout scm
            }
        }

        stage('Install Dependencies') {
            steps {
                // Install Laravel dependencies
                sh 'composer install'
            }
        }

        stage('Run Tests') {
            steps {
                // Run Laravel tests
                sh 'php artisan test'
            }
        }

        // Add more stages as needed (e.g., build, deploy, etc.)
    }
}
