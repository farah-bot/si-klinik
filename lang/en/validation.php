<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Validasi
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi pesan kesalahan default yang digunakan oleh
    | kelas validasi. Beberapa aturan memiliki beberapa versi seperti aturan ukuran.
    | Jangan ragu untuk mengubah pesan-pesan ini di sini.
    |
    */

    'accepted'             => ':attribute harus diterima.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi huruf.',
    'alpha_dash'           => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'            => ':attribute hanya boleh berisi huruf dan angka.',
    'array'                => ':attribute harus berupa sebuah array.',
    'before'               => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file'    => ':attribute harus antara :min dan :max kilobytes.',
        'string'  => ':attribute harus antara :min dan :max karakter.',
        'array'   => ':attribute harus memiliki antara :min dan :max item.',
    ],
    'boolean'              => 'Kolom :attribute harus bernilai benar atau salah.',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_format'          => ':attribute tidak cocok dengan format :format.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus :digits digit.',
    'digits_between'       => ':attribute harus antara :min dan :max digit.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => 'Kolom :attribute memiliki nilai yang duplikat.',
    'email'                => ':attribute harus berupa alamat email yang valid.',
    'exists'               => ':attribute tidak valid.',
    'file'                 => ':attribute harus berupa file.',
    'filled'               => 'Kolom :attribute harus memiliki nilai.',
    'gt'                   => [
        'numeric' => ':attribute harus lebih besar dari :value.',
        'file'    => ':attribute harus lebih besar dari :value kilobytes.',
        'string'  => ':attribute harus lebih besar dari :value karakter.',
        'array'   => ':attribute harus memiliki lebih dari :value item.',
    ],
    'gte'                  => [
        'numeric' => ':attribute harus lebih besar dari atau sama dengan :value.',
        'file'    => ':attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string'  => ':attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'   => ':attribute harus memiliki :value item atau lebih.',
    ],
    'image'                => ':attribute harus berupa gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => 'Kolom :attribute tidak ada di :other.',
    'integer'              => ':attribute harus berupa bilangan bulat.',
    'ip'                   => ':attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => ':attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => ':attribute harus berupa string JSON yang valid.',
    'lt'                   => [
        'numeric' => ':attribute harus kurang dari :value.',
        'file'    => ':attribute harus kurang dari :value kilobytes.',
        'string'  => ':attribute harus kurang dari :value karakter.',
        'array'   => ':attribute harus memiliki kurang dari :value item.',
    ],
    'lte'                  => [
        'numeric' => ':attribute harus kurang dari atau sama dengan :value.',
        'file'    => ':attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string'  => ':attribute harus kurang dari atau sama dengan :value karakter.',
        'array'   => ':attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'max'                  => [
        'numeric' => ':attribute tidak boleh lebih dari :max.',
        'file'    => ':attribute tidak boleh lebih dari :max kilobytes.',
        'string'  => ':attribute tidak boleh lebih dari :max karakter.',
        'array'   => ':attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes'                => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes'            => ':attribute harus berupa file dengan tipe: :values.',
    'min'                  => [
        'numeric' => ':attribute harus minimal :min.',
        'file'    => ':attribute harus minimal :min kilobytes.',
        'string'  => ':attribute harus minimal :min karakter.',
        'array'   => ':attribute harus memiliki minimal :min item.',
    ],
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'present'              => 'Kolom :attribute harus ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => 'Kolom :attribute wajib diisi.',
    'required_if'          => 'Kolom :attribute wajib diisi jika :other adalah :value.',
    'required_unless'      => 'Kolom :attribute wajib diisi kecuali :other ada dalam :values.',
    'required_with'        => 'Kolom :attribute wajib diisi jika :values ada.',
    'required_with_all'    => 'Kolom :attribute wajib diisi jika :values ada.',
    'required_without'     => 'Kolom :attribute wajib diisi jika :values tidak ada.',
    'required_without_all' => 'Kolom :attribute wajib diisi jika tidak ada :values yang ada.',
    'same'                 => ':attribute dan :other harus cocok.',
    'size'                 => [
        'numeric' => ':attribute harus :size.',
        'file'    => ':attribute harus :size kilobytes.',
        'string'  => ':attribute harus :size karakter.',
        'array'   => ':attribute harus mengandung :size item.',
    ],
    'starts_with'          => ':attribute harus dimulai dengan salah satu dari berikut: :values.',
    'string'               => ':attribute harus berupa string.',
    'timezone'             => ':attribute harus berupa zona waktu yang valid.',
    'unique'               => ':attribute sudah digunakan.',
    'uploaded'             => ':attribute gagal diunggah.',
    'url'                  => 'Format :attribute tidak valid.',
    'uuid'                 => ':attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa Kustom Validasi
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" untuk memberi nama baris. Ini membuatnya cepat
    | untuk menentukan baris bahasa kustom tertentu untuk aturan atribut tertentu.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'pesan-kustom',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atribut Validasi Kustom
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini digunakan untuk menukar placeholder atribut kami
    | dengan sesuatu yang lebih ramah pembaca seperti "Alamat E-Mail" sebagai
    | pengganti "email". Ini hanya membantu kita membuat pesan kita lebih ekspresif.
    |
    */

    'attributes' => [
        'no_rm' => 'Nomor Rekam Medis',
        'nik' => 'NIK',
        'jenis_kelamin' => 'Jenis Kelamin',
        'nama' => 'Nama Lengkap Pasien',
        'tanggal_lahir' => 'Tanggal Lahir',
        'alamat' => 'Alamat',
        'nomor_telepon' => 'Nomor Telepon',
        'jenis_pasien' => 'Jenis Pasien',
        'nomor_bpjs' => 'Nomor BPJS',
        'tanggal_kunjungan' => 'Tanggal Kunjungan',
        'poli_tujuan' => 'Poli Tujuan',
        'jenis_kunjungan' => 'Jenis Kunjungan',
        'nama_dokter' => 'Nama Dokter',
    ],

];
