# LaravelBP

Dasar ide: binusmaya / messier
Judul: uman (university manager)

## Features

- ✅ semester aktif
- ✅ ada transaksi yg gabungin kelas, jadwal, mhs, dan pengajar2nya
- datanya difilter per semester
- ✅ bisa login sbg mhs, pengajar, dan admin
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
  - ✅ alokasi transaksi mhs, kelas, dan pengajar
  - ✅ crud kelas (validation & error messages & pagination w/ searching)
  - ✅ crud mhs (validation & error messages & pagination w/ searching)
  - ✅ crud pengajar (validation & error messages & pagination w/ searching)

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
