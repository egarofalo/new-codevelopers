# WPElementor

WordPress development stack for building websites using **Docker**, **Composer** and **Symfony** components, with a default starter theme with **Bootstrap 4**, **Elementor** support for flexible page building and **Laravel Mix** integration for modern asset management.

## Initial Setup

### 1. Clone the repository

Clone this repository and rename it to your project name:

```bash
# Clone the repository to a new project folder
git clone https://github.com/egarofalo/wpelementor.git your-project-name

# Navigate to your new project directory
cd your-project-name

# Remove the original git history and initialize a new repository
rm -rf .git
git init
git add .
git commit -m "Initial commit"

# Add your new remote repository
git remote add origin https://github.com/yourusername/your-project-name.git
git branch -M master
git push -u origin master
```

### 2. Disable filemode in Git

After cloning the repository, run the following command in your local terminal to prevent Git from tracking file permission changes:

```bash
git config core.filemode false
```

This configuration is essential when working with Docker containers across different operating systems (Windows, macOS, Linux) to avoid false file modifications in Git.

### 3. Change theme name

To customize the theme name for your project, follow these steps:

- **Update the theme name in docker-compose.yml:**

    ```yaml
    environment:
        - THEME_NAME=your-new-theme-name
    ```

- **Rename the theme folder:**

    ```bash
    # Navigate to the themes directory
    cd web/wpelementor/public/content/themes/

    # Rename the folder from 'wpelementor' to your new theme name
    mv wpelementor your-new-theme-name
    ```

    **Update the .gitignore file:**

    ```
    # Exclude theme
    !/public/content/themes
    /public/content/themes/*
    !/public/content/themes/your-new-theme-name
    ```

- **Update the theme information in style.css:**

    ```css
    /*
    Theme Name: Your New Theme Name
    Description: Your theme description here
    Version: 1.0.0
    Author: Your Name
    */
    ```

**Note:** Make sure the `THEME_NAME` environment variable in `docker-compose.yml` matches exactly with your renamed theme folder.

### 4. Change containers and database names in `docker-compose.yml`

Customize the container names and database name to match your project:

- **Update container names:**

    ```yaml
    services:
        web:
            container_name: your-project-name_web # Change from wpelementor_web

        db:
            container_name: your-project-name_db # Change from wpelementor_db

        mailpit:
            container_name: your-project-name_mailpit # Change from wpelementor_mailpit
    ```

- **Update database name:**
    ```yaml
    db:
        environment:
            MYSQL_DATABASE: your-project-name # Change from wpelementor
    ```

**Example:** If your project is called `codevelopers`, use:

- Container names: `codevelopers_web`, `codevelopers_db`
- Database name: `codevelopers`

**Note:** Make sure to update your WordPress configuration `env` files accordingly if you change the database name.

### 5. Change project name in `Makefile`

Replace `PROJECT_NAME=wpelementor` variable with the new name, which match with containers names prefix, theme and database name.

### 6. Start the containers

Build and start the Docker containers:

```bash
# Build and start all services
docker-compose up --build

# Or run in detached mode (background)
docker-compose up --build -d

# Alternative you can use make command to start the containers
make up -d

# Or in dev mode with the execution of yarn watch
make dev
```

**Access your application:**

- **HTTP:** http://localhost:8080
- **HTTPS:** https://localhost:8443
