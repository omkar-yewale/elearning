# Drupal E-learning Test

This is an e-learning platform where students can enroll in available courses and engage in learning activities.

## About

Project Overview:
This project is a Drupal-based E-learning site designed to accommodate various roles, including Student, Instructor, and Admin. Each role has specific behaviors tailored to their responsibilities.

Features:
Courses and Lessons
The E-learning site revolves around courses and lessons. Each course is associated with multiple lessons.

Roles:
Instructor
Instructors have the ability to create and update courses and lessons. They can create courses at (/node/add/course) and lessons at (/node/add/lessons). Once courses and lessons are successfully created, they automatically appear on the "Find Your Course" page (/find-your-course), which is visible to both instructors and students.

Student
Students can navigate to the "Find Your Course" (/find-your-course) page, select a desired course from the list, and enroll in it. Enrolled courses can be viewed under the "My Learning" section (/my-courses/learning). Here, students can see all enrolled courses, their respective lessons, and individual course completion progress.

Completion Progress:
Course completion progress is calculated based on the completion of lessons. For example, if a course has 5 lessons and a student completes lesson 1, it signifies 20% completion of the course.

Lesson Completion:
To complete a lesson, students can navigate to the lesson page, complete the lesson, and find the "Complete Lesson" button at the bottom of the page. Once all lessons are completed, the overall progress is visible to students under the "My Learning" section.

Instructor Dashboard:
Instructors have the privilege to check the overall progress of students enrolled in their courses on their dashboard page (/dashboard).

Grading:
Upon reaching 100% completion of a course, instructors can see an "Add Grade" link on their dashboard. Instructors can assign grades to students and their enrolled courses. Grades can be modified at any time.

Certificate:
Upon 100% course completion, students can find a "View Certificate" button under the "My Learning" and "Completed course" section.

Validations:
Each student can enroll in a course only once. "Enroll course" button is no longer visible/accesiable for that particular course for that user.
Once a lesson is completed, the "Complete Lesson" button is no longer visible/accesiable for that particular lesson for that user.
Instructors can assign and modify grades for students and their enrolled courses.

Feel free to contact me for any issues or queries related to the project.

### Tools & Prerequisites

The site setup requires the following tools. Make sure to use either the latest version or, at a minimum, the version specified below.

* [Composer](https://getcomposer.org/download/)
* [Xampp] (https://www.apachefriends.org/download.html)
* OR (If you're not using XAMPP, you have the option to use DDEV.)
* [Docker](https://docs.docker.com/install/)
* [DDEV](https://ddev.readthedocs.io/en/stable/#installation)
* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

### Local environment setup

Once you have all the tools installed, proceed to clone the repository.

If you are utilizing XAMPP, configure it accordingly and execute the following commands to fetch all dependancies.

```bash
composer install
```

[Download the database](https://drive.google.com/file/d/1T8V90zz3M9sScwN9Mw4J8QFl6QQuQAgu/view?usp=sharing) and import accordingly.

After importing the database, consider rebuilding the cache. Subsequently, execute the configuration import and database update commands.

```bash
drush cr
drush cim
drush updb
```

For DDEV:
COnfigure the DEEV and run.

```bash
ddev config --project-type=drupal10 --docroot=web --create-docroot
```

```bash
ddev start
```

Once DDEV has been setup successfully, Next run the following to fetch all dependencies.

```bash
ddev composer install
```

[Download the database](https://drive.google.com/file/d/1T8V90zz3M9sScwN9Mw4J8QFl6QQuQAgu/view?usp=sharing) and import accordingly.

```bash
ddev import-db --src=elearning-db.sql.
```

After importing the database, consider rebuilding the cache. Subsequently, execute the configuration import and database update commands.

```bash
ddev drush cr
ddev drush cim
ddev drush updb
```

### After Installation

Generate a one time login link and reset the password through it.

```bash
drush uli
```

Clear the cache using drush.

```bash
drush cr
```

## Resources

1. [XAMPP Drupal Setup](https://www.drupal.org/docs/develop/local-server-setup/windows-development-environment/using-xampp/quick-install-drupal-with-xampp-on-windows)
2. [DDEV Drupal Setup](https://ddev.readthedocs.io/en/latest/users/install/ddev-installation/#__tabbed_1_3)

## Other

I've recorded a basic overview video of the e-learning site and added it to the repository. Please refer to this video for your reference.

If you encounter any issues or have any queries, please feel free to contact me.

Contact Information:

* Email: yewaleomkar@gmail.com
* Phone: +91 9967177564
* LinkedIn: [Omkar Yewale](https://www.linkedin.com/in/omkar-yewale-77a88ba2/)