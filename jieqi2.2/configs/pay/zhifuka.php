<?php
//zhifuka֧����ز���

$jieqiPayset['zhifuka']['payid']='123456';  //�̻����

$jieqiPayset['zhifuka']['paykey']='******';  //��Կֵ

$jieqiPayset['zhifuka']['payurl']='http://202.75.218.94/gateway/zfgateway.asp';  //�ύ���Է�����ַ

$jieqiPayset['zhifuka']['payreturn']='http://www.domain.com/modules/pay/zhifukareturn.php';  //���շ��صĵ�ַ (www.domain.com ��ָ�����ַ)


//���ò�ͬ���͵Ŀ���֧������Ӧ��������ң�Ĭ����������һ��1ԪǮ��Ӧ��������ң�1Ԫ���ϵĽ����Բ����ã��Զ�����1Ԫ�ı�������
//������ 'zfk'=>array(1=>100)����ʾ51֧����Ĭ��ÿԪ��ֵ100������ң������5Ԫ��500�㣬10Ԫ��1000��
//������ 'zfk'=>array(1=>100, 10=>1200)����ʾ51֧����ÿԪ��ֵ100������ң������5Ԫ��500�㣬10Ԫ��1200��(ע�⣺5Ԫ����Ϊû�о���Ķ�Ӧ���ã����԰�1Ԫ���ٱ������㣬��10Ԫ�ǵ����趨�˶�Ӧ��������ң������趨Ϊ׼)
$jieqiPayset['zhifuka']['cardegold'] = array(
//zfk-51֧���� 
'zfk'=>array(1=>100),
//szx-������
'szx'=>array(1=>100),
//qqb-Q�ҿ�
'qqb'=>array(1=>100),
//sdk-ʢ��
'sdk'=>array(1=>100),
//ztk-��;��
'ztk'=>array(1=>100),
//shk-�Ѻ���
'shk'=>array(1=>100),
//517-5173��֧��
'517'=>array(1=>100),
//jyk-���ο�
'jyk'=>array(1=>100),
//jwk-������
'jwk'=>array(1=>100),
//rxk-��Ѫ���濨֧��
'rxk'=>array(1=>100),
//msk-ħ�����翨֧��
'msk'=>array(1=>100),
//wmk-������֧��
'wmk'=>array(1=>100),
//ltk-��ͨ��֧��
'ltk'=>array(1=>100)
);

//֧�����ӻ���
//$jieqiPayset['zhifuka']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['zhifuka']['moneytype']='0';  //0 ����� 1��ʾ��Ԫ

$jieqiPayset['zhifuka']['paysilver']='0';  //0 ��ʾ��ֵ�ɽ�� 1��ʾ����

$jieqiPayset['zhifuka']['addvars']=array();  //���Ӳ���
?>