<?= Form::open() ?>

<div class="layout-row">
    <?= $this->formRenderPreview() ?>
</div>

<div class="form-buttons">
    <a
        href="<?= Backend::url('training/services/auditlogs') ?>"
        class="btn btn-default">
        Back to Audit Log
    </a>
</div>

<?= Form::close() ?>