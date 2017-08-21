# jan/01/2002 14:47:46 by RouterOS 6.0rc11
# software id = A7AW-TJBQ
#
/queue tree
add name=torrents packet-mark=torrents parent=global
add name=others packet-mark=others parent=global priority=5
add name=web packet-mark=web parent=global priority=1 queue=default
