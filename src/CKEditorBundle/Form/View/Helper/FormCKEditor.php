<?php
namespace CKEditorBundle\Form\View\Helper;
class FormCKEditor extends \Zend\Form\View\Helper\FormTextarea{
	/**
	 * @var \Zend\View\Helper\EscapeJs
	 */
	protected $escapeJsHelper;

	/**
	 * @see \Zend\Form\View\Helper\FormTextarea::render()
	 * @param \Zend\Form\ElementInterface $element
	 * @return string
	 */
	public function render(\Zend\Form\ElementInterface $oElement){
		return parent::render($oElement).$this->getEscapeJsHelper()->__invoke('
			CKEDITOR.replace('.\Zend\Json\Json::encode($oElement->getName()).');
		');
    }

    /**
     * @see \Zend\Form\View\Helper\FormTextarea::__invoke()
     * @param  ElementInterface|null $element
     * @return string|\CKEditorBundle\Form\View\HelperFormCKEditorHelper
     */
    public function __invoke(\Zend\Form\ElementInterface $oElement){
        return $oElement?$this->render($oElement):$this;
    }

    /**
     * Retrieve the escapeJs helper
     * @return \Zend\View\Helper\EscapeJs
     */
    protected function getEscapeJsHelper(){
    	if($this->escapeJsHelper)return $this->escapeJsHelper;
    	if(method_exists($this->view, 'plugin'))$this->escapeJsHelper = $this->view->plugin('escapejs');
    	if(!$this->escapeJsHelper instanceof \Zend\View\Helper\EscapeJs)$this->escapeJsHelper = new  \Zend\View\Helper\EscapeJs();
    	return $this->escapeJsHelper;
    }
}