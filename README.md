# php-ke-redis-ke-mysql

pertama file php untuk memparsing data yang kita inginnya contoh kita ingin memisakan ip dan date saya ambil dari data log nginx.log lalu 1 baris 
saya masukan ke regex dan saya buat code regex seperti yang ada di dalam file php 
untuk file uwsgi sama hanya berbeda datanya untuk pengunaanya hampir mirip

dan untuk file sh nya itu untuk mengambil data dari redis yang sudah di jadikan json karna kode php di atas sudah merubahnya jadi json 
jadi kita tinggal mengambilnya menggunakan shell scrip dan memakai fungsi lpop
