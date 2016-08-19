<?php

class Attachment extends AppModel {
    // upload
    public $actsAs = array(
        'Upload.Upload' => array(
            'photo' => array(
                'fields' => array(
                    'dir' => 'photo_dir'
                )
            )
        )
    );

    public $belongsTo = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id'
        )
    );

    public $validate = array(
        'photo' => array(
            'extension' => array(
                'rule' => array('extension', array(
                    'jpg', 'jpeg', 'png', 'gif', '')
                ),
                'message' => array('ファイルのアップロードに失敗しました。')
            )
        )
    );
}