<?php
//paypal֧����ز���

$jieqiPayset['paypal']['payid'] = '123456';  //�տ��˺�

$jieqiPayset['paypal']['paykey'] = '000000';  //��Կֵ

$jieqiPayset['paypal']['payurl'] = 'https://www.paypal.com/cgi-bin/webscr';  //�ύ���Է�����ַ

$jieqiPayset['paypal']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/paypalreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['paypal']['paynotify'] = JIEQI_LOCAL_URL.'/modules/pay/paypalnotify.php';  //����֪ͨ����ַ

$jieqiPayset['paypal']['payrate'] = 600; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['paypal']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['paypal']['paylimit'] = array('6000'=>'10', '12000'=>'20', '30000'=>'50', '60000'=>'100'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['paypal']['moneytype'] = '1';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['paypal']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['paypal']['cmd'] = '_xclick';  //֧������

$jieqiPayset['yeepay']['item_name'] = JIEQI_EGOLD_NAME;  //��Ʒ��

$jieqiPayset['paypal']['currency_code'] = 'USD';  //�������� USD-��Ԫ

$jieqiPayset['paypal']['rm'] = '1'; //֧���ɹ�����ʱ���Ƿ񷵻��ύ��ȥ�Ĳ�����GET��ʽ��1-���ز��� 0-������

$jieqiPayset['paypal']['cancel_return'] = JIEQI_LOCAL_URL.'/modules/pay/paypal.php';  //ȡ�����򷵻ص�ַ

$jieqiPayset['paypal']['no_shipping'] = '1'; //��û���ջ���ַ,1-����Ҫ�ջ���ַ 0-��Ҫ�ջ���ַ

$jieqiPayset['paypal']['no_note'] = '1';  //Ϊ���������ʾ�������Ϊ "1"���򲻻���ʾ���Ŀͻ�������ʾ���ñ���Ϊ��ѡ����ʡ�Ի���Ϊ "0"������ʾ���Ŀͻ�������ʾ��

$jieqiPayset['paypal']['image_url'] = ''; //��ʾ��վ֧����ͼƬ��150*50

$jieqiPayset['paypal']['addvars'] = array();  //���Ӳ���
?>