<?php
//sms֧����ز���

$jieqiPayset['sms']['payid']='12345678';  //�̻����

$jieqiPayset['sms']['paykey']='xxxxxxxx';  //Ĭ�ϵ�˽Կֵ������˽Կ��Ҫ�޸�����

$jieqiPayset['sms']['payurl']='http://218.206.80.238/qyhzapi/sendsms.jsp';  //�ύ���Է�����ַ

$jieqiPayset['sms']['payreturn']='http://www.domain.com/modules/pay/smsreturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)

//������������õĻ����û����Թ�������ֵ��������ң�����һԪǮ100�����㡣������������������������ֻ�ܰ�����������ã���Ӧ��Ҳ��Ǯ����Ӧ��ϵ���㣬�� '1000'=>'10' ��ָ 1000�������Ҫ10Ԫ
$jieqiPayset['sms']['paylimit']=array('1000'=>'10', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100');

$jieqiPayset['sms']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['sms']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['sms']['mydest']='0';  //�����ط���

$jieqiPayset['sms']['emoney']='100';  //��ȡ��Ǯ���֣�

$jieqiPayset['sms']['egold']='100';  //Ĭ���������

$jieqiPayset['sms']['ptype']='1';  //���շ��ֻ����͡�1=�ƶ��ֻ���2=��ͨ�ֻ�

$jieqiPayset['sms']['sid']='1315';  //1315 С˵�㲥�Ķ� 1000 ��Ѱ���

$jieqiPayset['sms']['mtype']='1';  //0=�����Ϣ��1=�����շѶ��ţ�2=�������¶��ţ�3=���»���

$jieqiPayset['sms']['fmt']='1';  //��Ϣ���롣1=GB, 2=ASCII, 3=Binary, 4=UCS2. Ĭ��ֵ��GB. (Binary, UCS2��ʱ��֧��)

$jieqiPayset['sms']['uflag']='0';  //0=��ͨ��Ϣ��Ĭ�ϣ���1=ע����Ϣ��2=ע����Ϣ�����ڶ���ҵ�񣬵��û�ע��ʹ�ø÷���ʱ��uflag=1; ���û�ȡ��ʹ�ø÷���ʱ��uflag=2;����uflag=0���㲥ҵ��uflag=0.

$jieqiPayset['sms']['startmsg']='NA';  //������Ϣ��ʼ���

$jieqiPayset['sms']['daymsg']='10';  //ÿ����෢����Ϣ��

$jieqiPayset['sms']['message']='ID��<{$userid}>���û�����<{$username}>��<{$egold}> ��������Ѿ����ʣ����½�����գ�(�ʷ�1Ԫ/����������ţ�<{$serialno}>)';  //������Ϣ����

$jieqiPayset['sms']['addvars']=array();  //���Ӳ���
?>