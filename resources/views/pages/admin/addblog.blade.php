@extends('layouts.admin')
@section('title', 'Add Blog ')

@section('content')
    <div class="main-content">
        <div class="page-content ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Blog</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                                    <li class="breadcrumb-item active">Create Blog</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ url('admin/createblogs') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="name" class="form-label">Blog Title</label>
                                                    <input class="form-control" type="text" placeholder="Blog Title"
                                                        id="name" name="name" required>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="slug" class="form-label">Blog Slug</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Slug (URL Path https://abc.com/blog/my-blog-url)"
                                                        id="slug" name="slug" required>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="image" class="form-label">Blog Image</label>
                                                    <input class="form-control" type="file" name="image" id="image"
                                                        placeholder="Blog Description" required>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="blogbanner" class="form-label">Blog Banner</label>
                                                    <input class="form-control" type="file" name="blogbanner"
                                                        id="blogbanner" placeholder="Blog Banner" required>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Blog Meta Title (SEO) 50–60 characters" id="meta_title"
                                                        name="meta_title" required>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="meta_description" class="form-label">Meta Description
                                                        (SEO)</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Blog Meta Description (SEO) 150–160 characters"
                                                        id="meta_description" name="meta_description" required>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <label class="form-label">Blog
                                                        Content</label>
                                                    <textarea id="description_content" name="description_content"></textarea>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="meta_keywords" class="form-label">Meta keywords
                                                        (SEO)</label>
                                                    <textarea class="form-control" row="4" placeholder="Blog Meta keywords (SEO)" id="meta_keywords"
                                                        name="meta_keywords"></textarea>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="meta_schema" class="form-label">Meta schema (SEO)</label>
                                                    <textarea class="form-control" row="4" placeholder="Blog Meta schema (SEO)" id="meta_schema" name="meta_schema"></textarea>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="canonical" class="form-label">Canonical URL (SEO)</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Blog Canonical URL (SEO)" id="canonical"
                                                        name="canonical">
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="og_image" class="form-label">OG Image (SEO)</label>
                                                    <input class="form-control" type="file"
                                                        placeholder="Blog OG Image (SEO)" id="og_image" name="og_image">
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label for="custom_js" class="form-label">Custom JS</label>
                                                    <textarea class="form-control" row="4" placeholder="Blog Custom JS (SEO)" id="custom_js" name="custom_js"></textarea>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="custom_css" class="form-label">Custom CSS (SEO)</label>
                                                    <textarea class="form-control" row="4" placeholder="Blog Custom CSS (SEO)" id="custom_css"
                                                        name="custom_css"></textarea>
                                                </div>

                                                <div class="mb-3 col-6">
                                                    <label for="no_index" class="form-label">No Index</label>
                                                    <select class="form-control" id="no_index" name="no_index" required>
                                                        <option value="0" selected>No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="featured" class="form-label">Featured</label>
                                                    <select class="form-control" id="featured" name="featured" required>
                                                        <option value="1" selected>Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="breadcrumb" class="form-label">Breadcrumb (SEO)</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Blog Breadcrumb (SEO)" id="breadcrumb"
                                                        name="breadcrumb" required>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="author" class="form-label">Author
                                                        (SEO)</label>
                                                    <input class="form-control" type="text"
                                                        placeholder="Blog Author (SEO)"
                                                        id="author" name="author" required>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <button class="btn btn-primary" type="submit">Add Blog</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.components.footer')
    </div>
@endsection

@section('scripts')
    <script>
        $('#datatable').DataTable();
    </script>

        <!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
{{-- <script>
  tinymce.init({
    selector: 'textarea#description_content',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      // Your account includes a free trial of TinyMCE premium features
      // Try the most popular premium features until Nov 21, 2024:
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
      // Early access to document converters
      'importword', 'exportword', 'exportpdf',
      'advlist',  'preview',  'pagebreak',
      'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'help'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    exportpdf_converter_options: { 'format': 'Letter', 'margin_top': '1in', 'margin_right': '1in', 'margin_bottom': '1in', 'margin_left': '1in' },
    exportword_converter_options: { 'document': { 'size': 'Letter' } },
    importword_converter_options: { 'formatting': { 'styles': 'inline', 'resets': 'inline',	'defaults': 'inline', } },
  });
</script> --}}

<script>
  tinymce.init({
    selector: 'textarea#description_content',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'advlist', 'preview', 'pagebreak',
      'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'help'
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>

@endsection
