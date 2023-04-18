<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language settings
return [
    // Core Messages
    'noRuleSets'      => '- Tidak ada aturan yang ditentukan dalam konfigurasi Validasi.',
    'ruleNotFound'    => '- "{0}" bukan sebuah aturan yang valid.',
    'groupNotFound'   => '- "{0}" bukan sebuah grup aturan validasi.',
    'groupNotArray'   => '- "{0}" grup aturan harus berupa sebuah array.',
    'invalidTemplate' => '- "{0}" bukan sebuah template Validasi yang valid.',

    // Rule Messages
    'alpha'                 => '- Bidang <b>{field}</b> hanya boleh mengandung karakter alfabet.',
    'alpha_dash'            => '- Bidang <b>{field}</b> hanya boleh berisi karakter alfanumerik, setrip bawah, dan tanda pisah.',
    'alpha_numeric'         => '- Bidang <b>{field}</b> hanya boleh berisi karakter alfanumerik.',
    'alpha_numeric_punct'   => '- Bidang <b>{field}</b> hanya boleh berisi karakter alfanumerik, spasi, dan karakter ~! # $% & * - _ + = | :..',
    'alpha_numeric_space'   => '- Bidang <b>{field}</b> hanya boleh berisi karakter alfanumerik dan spasi.',
    'alpha_space'           => '- Bidang <b>{field}</b> hanya boleh berisi karakter alfabet dan spasi.',
    'decimal'               => '- Bidang <b>{field}</b> harus mengandung sebuah angka desimal.',
    'differs'               => '- Bidang <b>{field}</b> harus berbeda dari bidang <b>{param}</b>.',
    'equals'                => '- Bidang <b>{field}</b> harus persis: <b>{param}</b>.',
    'exact_length'          => '- Bidang <b>{field}</b> harus tepat <b>{param}</b> panjang karakter.',
    'greater_than'          => '- Bidang <b>{field}</b> harus berisi sebuah angka yang lebih besar dari <b>{param}</b>.',
    'greater_than_equal_to' => '- Bidang <b>{field}</b> harus berisi sebuah angka yang lebih besar atau sama dengan <b>{param}</b>.',
    'hex'                   => '- Bidang <b>{field}</b> hanya boleh berisi karakter heksadesimal.',
    'in_list'               => '- Bidang <b>{field}</b> harus salah satu dari: <b>{param}</b>.',
    'integer'               => '- Bidang <b>{field}</b> harus mengandung bilangan bulat.',
    'is_natural'            => '- Bidang <b>{field}</b> hanya boleh berisi angka.',
    'is_natural_no_zero'    => '- Bidang <b>{field}</b> hanya boleh berisi angka dan harus lebih besar dari nol.',
    'is_not_unique'         => '- Bidang <b>{field}</b> harus berisi nilai yang sudah ada sebelumnya dalam database.',
    'is_unique'             => '- Bidang <b>{field}</b> harus mengandung sebuah nilai unik.',
    'less_than'             => '- Bidang <b>{field}</b> harus berisi sebuah angka yang kurang dari <b>{param}</b>.',
    'less_than_equal_to'    => '- Bidang <b>{field}</b> harus berisi sebuah angka yang kurang dari atau sama dengan <b>{param}</b>.',
    'matches'               => '- Bidang <b>{field}</b> tidak cocok dengan bidang <b>{param}</b>.',
    'max_length'            => '- Bidang <b>{field}</b> tidak bisa melebihi <b>{param}</b> panjang karakter.',
    'min_length'            => '- Bidang <b>{field}</b> setidaknya harus <b>{param}</b> panjang karakter.',
    'not_equals'            => '- Bidang <b>{field}</b> tidak boleh: <b>{param}</b>.',
    'not_in_list'           => '- Bidang <b>{field}</b> tidak boleh salah satu dari: <b>{param}</b>.',
    'numeric'               => '- Bidang <b>{field}</b> hanya boleh mengandung angka.',
    'regex_match'           => '- Bidang <b>{field}</b> tidak dalam format yang benar.',
    'required'              => '- Bidang <b>{field}</b> diperlukan.',
    'required_with'         => '- Bidang <b>{field}</b> diperlukan saat <b>{param}</b> hadir.',
    'required_without'      => '- Bidang <b>{field}</b> diperlukan saat <b>{param}</b> tidak hadir.',
    'string'                => '- Bidang <b>{field}</b> harus berupa string yang valid.',
    'timezone'              => '- Bidang <b>{field}</b> harus berupa sebuah zona waktu yang valid.',
    'valid_base64'          => '- Bidang <b>{field}</b> harus berupa sebuah string base64 yang valid.',
    'valid_email'           => '- Bidang <b>{field}</b> harus berisi sebuah alamat surel yang valid.',
    'valid_emails'          => '- Bidang <b>{field}</b> harus berisi semua alamat surel yang valid.',
    'valid_ip'              => '- Bidang <b>{field}</b> harus berisi sebuah IP yang valid.',
    'valid_url'             => '- Bidang <b>{field}</b> harus berisi sebuah URL yang valid.',
    'valid_url_strict'      => '- Bidang <b>{field}</b> harus berisi sebuah URL yang valid.',
    'valid_date'            => '- Bidang <b>{field}</b> harus berisi sebuah tanggal yang valid.',
    'valid_json'            => '- Bidang <b>{field}</b> harus berisi sebuah json yang valid.',

    // Credit Cards
    'valid_cc_num' => '- <b>{field}</b> tidak tampak sebagai sebuah nomor kartu kredit yang valid.',

    // Files
    'uploaded' => '- <b>{field}</b> bukan sebuah berkas diunggah yang valid.',
    'max_size' => '- <b>{field}</b> terlalu besar dari sebuah berkas.',
    'is_image' => '- <b>{field}</b> bukan berkas gambar diunggah yang valid.',
    'mime_in'  => '- <b>{field}</b> tidak memiliki sebuah tipe mime yang valid.',
    'ext_in'   => '- <b>{field}</b> tidak memiliki sebuah ekstensi berkas yang valid.',
    'max_dims' => '- <b>{field}</b> bukan gambar, atau terlalu lebar atau tinggi.',
];