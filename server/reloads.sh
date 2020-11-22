echo "loading.."
pid=`pidof live`
echo $pid
kill -USR1 $pid
echo "loading success"

