<?php
//�ױ�����֧����ز���

$jieqiPayset['yeepay']['payid'] = '10012408238';  //�������ID��������ʵ�������ֵ��

$jieqiPayset['yeepay']['paykey'] = '54928G080r86S64B77a5Z45DA4U6IT61hd2189x040o758QA8L0rypj96K09';  //ͨѶ��Կֵ��������ʵ�������ֵ��

$jieqiPayset['yeepay']['payurl'] = 'https://www.yeepay.com/app-merchant-proxy/node';  //�ύ��֧����վ����ַ

$jieqiPayset['yeepay']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/yeepayreturn.php';  //��վ���շ��ص���ַ

$jieqiPayset['yeepay']['payrate'] = 100; //Ĭ��1ԪǮ�һ�����ҵ�ֵ
$jieqiPayset['yeepay']['paycustom'] = 0; //�Ƿ������Զ��幺���0-������1-����
$jieqiPayset['yeepay']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //����ѡ��� �����=>��� ѡ��� '1000'=>'10' ��ָ���� 1000�������Ҫ10Ԫ

$jieqiPayset['yeepay']['moneytype'] = '0';  //�ֽ����ͣ�0-����� 1-��Ԫ
$jieqiPayset['yeepay']['paysilver'] = '0';  //���������:0-��� 1-����(Ŀǰ�����ҹ��ܣ���Ĭ�����ó�0)

//����˽�в���
$jieqiPayset['yeepay']['addressFlag'] = '0';  //��Ҫ��д�ͻ���Ϣ 0������Ҫ  1:��Ҫ

$jieqiPayset['yeepay']['messageType'] = 'Buy';  //ҵ������

$jieqiPayset['yeepay']['cur'] = 'CNY';  //���ҵ�λ

$jieqiPayset['yeepay']['productId'] = JIEQI_EGOLD_NAME;  //��Ʒ��

$jieqiPayset['yeepay']['productDesc'] = JIEQI_EGOLD_NAME;  //��Ʒ����

$jieqiPayset['yeepay']['productCat'] = '';  //��Ʒ����

$jieqiPayset['yeepay']['sMctProperties'] = '';  //���Ӳ���

$jieqiPayset['yeepay']['frpId'] = '';  //���Ӳ���

$jieqiPayset['yeepay']['needResponse'] = '0';  //�Ƿ���ҪӦ����ƣ�Ĭ�ϻ�"0"Ϊ����Ҫ,"1"Ϊ��Ҫ

$jieqiPayset['yeepay']['addvars'] = array();  //���Ӳ���

?>