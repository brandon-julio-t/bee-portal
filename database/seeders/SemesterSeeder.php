<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = [
            ['name' => 'Short Semester 2020/2021', 'active_at' => null],
            ['name' => 'Short Semester 2010', 'active_at' => '2010-08-18 10:58:33.533'],
            ['name' => 'Odd Semester 2010/2011', 'active_at' => '2010-08-31 13:17:26.213'],
            ['name' => 'Even Semester 2010/2011', 'active_at' => '2011-02-14 00:00:00.000'],
            ['name' => 'Short Semester 2011', 'active_at' => '2011-06-30 00:00:00.000'],
            ['name' => 'Odd Semester 2011/2012', 'active_at' => '2011-09-05 00:00:00.000'],
            ['name' => 'Even Semester 2011/2012', 'active_at' => '2012-02-14 00:00:00.000'],
            ['name' => 'Short Semester 2012', 'active_at' => '2012-07-03 00:00:00.000'],
            ['name' => 'Odd Semester 2012/2013', 'active_at' => '2012-09-03 00:00:00.000'],
            ['name' => 'Even Semester 2012/2013', 'active_at' => '2013-02-16 00:00:00.000'],
            ['name' => 'Short Semester 2013', 'active_at' => '2013-07-05 00:00:00.000'],
            ['name' => 'Odd Semester 2013/2014', 'active_at' => '2013-09-22 00:00:00.000'],
            ['name' => 'Even Semester 2013/2014', 'active_at' => '2014-02-23 00:00:00.000'],
            ['name' => 'Short Semester 2014', 'active_at' => '2014-07-01 00:00:00.000'],
            ['name' => 'Odd Semester 2014/2015', 'active_at' => '2014-09-20 00:00:00.000'],
            ['name' => 'Even Semester 2014/2015', 'active_at' => '2015-02-21 00:00:00.000'],
            ['name' => 'Short Semester 2015', 'active_at' => '2015-06-28 00:00:00.000'],
            ['name' => 'Odd Semester 2015/2016', 'active_at' => '2015-09-20 00:00:00.000'],
            ['name' => 'Even Semester 2015/2016', 'active_at' => '2016-02-20 00:00:00.000'],
            ['name' => 'Short Semester 2016', 'active_at' => '2016-07-02 00:00:00.000'],
            ['name' => 'Odd Semester 2016/2017', 'active_at' => '2016-09-15 00:00:00.000'],
            ['name' => 'Even Semester 2016/2017', 'active_at' => '2017-02-15 00:00:00.000'],
            ['name' => 'Short Semester 2017', 'active_at' => '2017-07-14 00:00:00.000'],
            ['name' => 'Odd Semester 2017/2018', 'active_at' => '2017-09-18 00:00:00.000'],
            ['name' => 'Even Semester 2017/2018', 'active_at' => '2018-02-16 00:00:00.000'],
            ['name' => 'Short Semester 2018', 'active_at' => '2018-07-18 00:00:00.000'],
            ['name' => 'Odd Semester 2018/2019', 'active_at' => '2018-09-07 00:00:00.000'],
            ['name' => 'Even Semester 2018/2019', 'active_at' => '2019-02-02 00:00:00.000'],
            ['name' => 'Short Semester 2019', 'active_at' => '2019-07-04 00:00:00.000'],
            ['name' => 'Odd Semester 2019/2020', 'active_at' => '2019-09-13 00:00:00.000'],
            ['name' => 'Even Semester 2019/2020', 'active_at' => '2020-01-24 00:00:00.000'],
            ['name' => 'BCA 2012', 'active_at' => '2020-06-28 23:00:00.000'],
            ['name' => 'Short Semester 2020', 'active_at' => '2020-06-29 00:00:00.000'],
            ['name' => 'BCA 2010', 'active_at' => '2020-08-07 00:00:00.000'],
            ['name' => 'BCA 2020', 'active_at' => '2020-08-20 00:00:00.000'],
            ['name' => 'Odd Semester 2020/2021', 'active_at' => '2021-01-12 00:00:00.000'],
            ['name' => 'Even Semester 2020/2021', 'active_at' => '2021-01-21 00:00:00.000'],
            ['name' => 'Short Semester 2021', 'active_at' => '2021-07-31 00:00:00.000'],
            ['name' => 'BCA 2120', 'active_at' => '2021-09-22 00:00:00.000'],
            ['name' => 'Odd Semester 2021/2022', 'active_at' => '2021-09-23 00:00:00.000'],
        ];

        foreach ($semesters as $semester) {
            $data = collect($semester)->merge(['id' => Str::uuid()])->all();
            Semester::create($data);
        }
    }
}
