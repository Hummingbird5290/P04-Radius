# jan/01/2002 08:28:35 by RouterOS 6.0rc11
# software id = A7AW-TJBQ
#
/ip hotspot walled-garden
add comment="place hotspot rules here" disabled=yes
add dst-host=61.19.73.174
add dst-host=103.4.217.74
add dst-host=radius.t-voip0.zapto.org
add dst-host=8.8.8.8
add dst-port=81
/ip hotspot walled-garden ip
add action=accept disabled=no !dst-address dst-host=radius.t-voip0.zapto.org \
    !dst-port !protocol !src-address
add action=accept disabled=no !dst-address dst-host=8.8.8.8 !dst-port \
    !protocol !src-address
add action=accept disabled=no !dst-address dst-host=tmtopup.thaighost.net \
    !dst-port !protocol !src-address
add action=accept disabled=no !dst-address dst-host=192.168.73.1 !dst-port \
    !protocol !src-address
add action=accept disabled=no dst-address=192.168.73.1 !dst-port !protocol \
    !src-address
add action=accept disabled=no !dst-address dst-host=203.113.115.199 !dst-port \
    !protocol !src-address
add action=accept disabled=no dst-address=202.29.80.0/24 !dst-port !protocol \
    !src-address
add action=accept comment="HOSTPORT PSRU" disabled=no dst-address=\
    202.29.81.0/24 !dst-port !protocol !src-address
add action=accept comment="HOSTPORT PSRU" disabled=no dst-address=\
    203.113.115.199 !dst-port !protocol !src-address
add action=accept disabled=no dst-address=61.19.73.174 dst-port=81 protocol=\
    tcp !src-address
add action=accept disabled=no !dst-address dst-host=61.19.73.174 !dst-port \
    !protocol !src-address
add action=accept disabled=no dst-address=61.19.73.174 dst-port=80 protocol=\
    tcp server=HOME-YIM !src-address
add action=accept comment=TRUE disabled=no !dst-address dst-host=\
    tmtopup.thaighost.net !dst-port !protocol !src-address
add action=accept comment=TRUE disabled=no dst-address=103.4.217.74 !dst-port \
    !protocol !src-address
add action=accept disabled=no dst-address=192.168.1.1 !dst-port !protocol \
    !src-address
add action=accept disabled=no !dst-address dst-host=192.168.1.1 !dst-port \
    !protocol !src-address
