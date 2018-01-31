<h1 align="center">
  <img alt="hetic-panel" width="652" src="https://jclerc.github.io/assets/repos/banner/hetic-panel.jpg">
  <br>
</h1>

<p align="center">
  <img alt="made for: school" src="https://jclerc.github.io/assets/static/badges/made-for/school.svg">
  <img alt="language: php" src="https://jclerc.github.io/assets/static/badges/language/php.svg">
  <img alt="made in: 2016" src="https://jclerc.github.io/assets/static/badges/made-in/2016.svg">
  <br>
  <sub>Panel for students and staff to manage class attendance.</sub>
</p>
<br>

## Features

- [x] Student: see your absences and submit a medical certificate or another proof
- [x] Teacher: see student list to take attendance and see who is missing
- [x] Staff: accept or decline medical certificates; manage users, courses, promotions, ...

## Stack used

- PHP `7.0`
- MySQL `5.5`
- Apache `2.2`

## Getting started

#### Requirements

- Apache server with PHP 5.6 or 7+
- A recent MySQL server

#### Installation

```sh
git clone https://github.com/jclerc/hetic-panel.git
cd hetic-panel
```

Then create a MySQL database named `hetic_panel`, and import data from `sql/hetic_panel.sql` file.
Once it's done, start the webserver in this directory.

## Notes

- Passwords are the same as usernames, take a look at the sql file to see them.
