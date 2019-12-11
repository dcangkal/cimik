# codeigniter-mikrotik-api
CiMik didevelop menggunakan API PHP mikrotik dikombinasi dengan Framework Codeigniter. Service yang diberikan untuk saat ini adalah VPN, yang nantinya akan menambah service lainnya.

[UPDATE]

07 Desember 2019
- update library MIKROTIK API versi 6.45 up
- menambahkan fitur HOME/IPADDRESS get ip-address lokal vpn untuk remote ip address
- tambah filter sebelum ke menu NAT cek ip-address sudah tersetting
- tambah filter untuk menyamakan ip-address dengan to-addresses apabila ada perbedaan
- menambahkan fitur NAT/ADD add port remote
    - to-address menyesuaikan pada menu HOME/IPADDRESS get ip-address
    - port digunakan bersadarkan port yang tersedia
        - dst-port : 8000-9000
        - to-ports : 10-10000
    - port remote maksimal 10 port
- menambahkan fitur NAT/EDIT edit port remote
    - [rule] edit port hanya sesuai user, user tidak bisa edit port user lain
- menambahkan fitur NAT/DELETE delete port remote
    - [rule] hapus port hanya sesuai user, user tidak bisa hapus port user lain


07 Mei 2019
- menambah fitur HOME/PASSWORD change password
- perbaikan form register, pengecekan email dan username.

© CiMik. With love from Indonesia
