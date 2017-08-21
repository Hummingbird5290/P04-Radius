# jan/01/2002 14:49:48 by RouterOS 6.0rc11
# software id = A7AW-TJBQ
#
/ip firewall mangle
add action=mark-packet chain=prerouting dst-port=1000-65535 new-packet-mark=\
    others protocol=tcp src-address=10.0.0.0/8
add action=mark-packet chain=postrouting dst-port=1000-65535 new-packet-mark=\
    others protocol=tcp src-address=10.0.0.0/8
add action=mark-packet chain=prerouting dst-port=1000-65535 new-packet-mark=\
    others protocol=udp src-address=10.0.0.0/8
add action=mark-packet chain=postrouting dst-port=1000-65535 new-packet-mark=\
    others protocol=udp src-address=10.0.0.0/8
add action=mark-packet chain=prerouting comment=torrent new-packet-mark=\
    torrents p2p=bit-torrent
add action=mark-packet chain=postrouting comment=torrent new-packet-mark=\
    torrents p2p=bit-torrent
add action=mark-packet chain=postrouting comment=torrent layer7-protocol=\
    bittorrent new-packet-mark=torrents
add action=mark-packet chain=prerouting comment=torrent layer7-protocol=\
    bittorrent new-packet-mark=torrents
add action=mark-packet chain=prerouting comment=web new-packet-mark=web port=\
    80,443,53 protocol=tcp
add action=mark-packet chain=postrouting comment="web 80,443,53" \
    new-packet-mark=web port=80,443,53 protocol=tcp
add action=log chain=prerouting comment=LOG connection-state=established \
    disabled=yes src-address=10.0.0.0/8
add action=log chain=postrouting comment=LOG connection-state=established \
    disabled=yes src-address=10.0.0.0/8
