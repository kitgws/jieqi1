<?php 


jieqi_includedb();
//�û���
class JieqiMonthlybuy extends JieqiObjectData
{
	//��������
	public function JieqiMonthlybuy()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '���', false, 11);
		$this->initVar('userid', JIEQI_TYPE_INT, 0, '�û����', true, 11);
		$this->initVar('username', JIEQI_TYPE_TXTBOX, 0, '�û���', true, 250);
		$this->initVar('bookid', JIEQI_TYPE_INT, '', '�������', false, 250);
		$this->initVar('bookname', JIEQI_TYPE_TXTAREA, '', '�������', false, 250);
		$this->initVar('text', JIEQI_TYPE_TXTAREA, '', '������������', false, 11);
		$this->initVar('texts', JIEQI_TYPE_TXTAREA, '', '�߸��û����', false, 11);
		$this->initVar('date', JIEQI_TYPE_INT, 0, '����ʱ��', false, 11);
		$this->initVar('typeid', JIEQI_TYPE_INT, 0, '״̬', false, 11);
		$this->initVar('type', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('pc', JIEQI_TYPE_TXTBOX, 0, 'pc', true, 250);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//���ݾ��
class JieqiMonthlybuyHandler extends JieqiObjectHandler
{
	function JieqiMonthlybuyHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='monthlybuy';
	    $this->autoid='id';	
	    $this->dbname='article_mouthlybuy';
	}
}

?>