# LaravelBP

Dasar ide: binusmaya / messier
Judul: uman (university manager)

## Features

- semester aktif
- ada transaksi yg gabungin kelas, jadwal, mhs, dan pengajar2nya
- datanya difilter per semester
- bisa login sbg mhs, pengajar, dan admin
- forum reply infinite scrolling (ajax & api + authorize hanya mhs/dosen yg ada di kelas itu yg bisa view)
- mhs (middleware & authorization)
  - view courses
  - view assignment per kelas dan kumpul jwbn (validation & error messages)
  - view nilai
  - crud forum & replynya (validation & error messages)
- pengajar (middleware & authorization)
  - submit nilai
  - bikin assignment per kelas
  - crud forum & replynya (validation & error messages)
- admin (middleware & authorization)
  - alokasi transaksi mhs, kelas, dan pengajar
  - crud kelas (validation & error messages)
  - crud mhs (validation & error messages)
  - crud pengajar (validation & error messages)

## Master Tables

- semesters
  - id
  - name
  - start_date
  - end_date
- courses
  - id
  - code (ISYS6169)
  - name (Database System)
  - sessions_count
- users
  - id
  - code (2301885466 buat mhs / D1234 buat lecturer)
  - name
  - email
  - phone
  - password
  - role_id
  - semester_id
- roles
  - id
  - role_name
- classes
  - id
  - class_name
  - course_id
- shifts
  - id
  - start_time (11.20)
  - end_time (13.00)
- forums
  - id
  - title
  - description
  - user_id
  - class_id
- forum_replies
  - id
  - forum_id
  - user_id
  - description
  - file_path (nullable, zip only)
- assignment
  - id
  - class_id
  - user_id
  - case_path (/cases/case01.zip)
  - ends_at

transactions tables:
- student_classe
  - id
  - transaction_date
  - student_id
  - class_id
  - shift_id
  - semester_id
- student_score
  - id
  - score
  - student_id
  - course_id
  - semester_id
- course_session
  - id
  - course_id
  - semester_id
  - session_number
  - note
- student_assignment
  - id
  - student_id
  - assignment_id
  - answer_path (/answers/studentcode.zip)

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
