pipeline {
    agent any
  
    stages {
        stage('Build') {
            steps {
                sh 'composer install'
            }
        }
        stage('Test') {
            steps {
                sh 'composer check'
            }
        }
        stage('Deploy') {
            steps {
              sh 'ssh -o StrictHostKeyChecking=no ubuntu@192.168.1.26 "cd appagendamento; \
              git pull origin main; \
              composer install --optimize-autoloader --no-dev; \
              composer update "'
            }
        }
    }
}
