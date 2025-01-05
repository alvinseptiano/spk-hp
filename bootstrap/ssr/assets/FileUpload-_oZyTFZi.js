import { mergeProps, useSSRContext, ref, onMounted, withCtx, unref, createTextVNode, createVNode, toDisplayString, openBlock, createBlock, createCommentVNode, Fragment, renderList } from "vue";
import { ssrRenderAttrs, ssrInterpolate, ssrRenderSlot, ssrRenderComponent, ssrIncludeBooleanAttr, ssrRenderStyle, ssrRenderList, ssrRenderAttr } from "vue/server-renderer";
import axios from "axios";
import { _ as _sfc_main$2 } from "./AuthenticatedLayout-DALFCgFp.js";
import { Head } from "@inertiajs/vue3";
import { TrashIcon } from "@heroicons/vue/24/solid";
import { _ as _sfc_main$3 } from "./Checkbox-CFe2cyP3.js";
const _sfc_main$1 = {
  __name: "Heading",
  __ssrInlineRender: true,
  props: {
    value: {
      type: String
    }
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<label${ssrRenderAttrs(mergeProps({ class: "divider text-xl font-bold" }, _attrs))}>`);
      if (__props.value) {
        _push(`<span>${ssrInterpolate(__props.value)}</span>`);
      } else {
        _push(`<span>`);
        ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
        _push(`</span>`);
      }
      _push(`</label>`);
    };
  }
};
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/Heading.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {
  __name: "FileUpload",
  __ssrInlineRender: true,
  emits: ["upload-success"],
  setup(__props, { emit: __emit }) {
    const selectedFiles = ref([]);
    const loading = ref(false);
    const success = ref(false);
    const error = ref(null);
    const uploading = ref(false);
    const fileInput = ref(null);
    const progress = ref(0);
    const startTime = ref(null);
    const processingTime = ref(0);
    const uploadSpeed = ref(0);
    const estimatedTimeRemaining = ref(0);
    const emit = __emit;
    onMounted(() => {
      var _a;
      const token = (_a = document.querySelector('meta[name="csrf-token"]')) == null ? void 0 : _a.content;
      if (token) {
        axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
      }
    });
    const formatTime = (seconds) => {
      if (seconds < 60) {
        return `${seconds.toFixed(1)} seconds`;
      }
      const minutes = Math.floor(seconds / 60);
      const remainingSeconds = seconds % 60;
      return `${minutes}m ${remainingSeconds.toFixed(0)}s`;
    };
    const calculateSpeed = (loaded, elapsed) => {
      const speed = loaded / (elapsed / 1e3);
      if (speed > 1e6) {
        return `${(speed / 1e6).toFixed(2)} MB/s`;
      }
      if (speed > 1e3) {
        return `${(speed / 1e3).toFixed(2)} KB/s`;
      }
      return `${speed.toFixed(2)} B/s`;
    };
    const formatFileSize = (bytes) => {
      if (bytes === 0) return "0 Bytes";
      const k = 1024;
      const sizes = ["Bytes", "KB", "MB", "GB"];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
    };
    const handleFileSelect = (event) => {
      const files = event.target.files;
      if (!files) return;
      selectedFiles.value = Array.from(files).map((file) => ({
        name: file.name,
        size: file.size,
        file
        // Keep the original file object for upload
      }));
      console.log(selectedFiles.value);
      error.value = null;
      success.value = false;
      progress.value = 0;
      processingTime.value = null;
      uploadSpeed.value = 0;
      estimatedTimeRemaining.value = null;
    };
    const removeFile = (index) => {
      selectedFiles.value = selectedFiles.value.filter((_, i) => i !== index);
      if (selectedFiles.value.length === 0) {
        fileInput.value.value = "";
        processingTime.value = null;
        uploadSpeed.value = 0;
        estimatedTimeRemaining.value = null;
      }
    };
    const uploadFile = async () => {
      if (!selectedFiles.value.length) return;
      const formData = new FormData();
      selectedFiles.value.forEach((fileObj, index) => {
        formData.append(`files[${index}]`, fileObj.file);
      });
      formData.append("passphrase", document.getElementById("passphrase").value);
      formData.append("nonce", document.getElementById("nonce").value);
      loading.value = true;
      uploading.value = true;
      error.value = null;
      startTime.value = Date.now();
      processingTime.value = null;
      try {
        const response = await axios.post("/upload", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          },
          onUploadProgress: (progressEvent) => {
            const currentTime = Date.now();
            const elapsed = (currentTime - startTime.value) / 1e3;
            progress.value = Math.round(
              progressEvent.loaded * 100 / progressEvent.total
            );
            uploadSpeed.value = calculateSpeed(
              progressEvent.loaded,
              currentTime - startTime.value
            );
            const remainingBytes = progressEvent.total - progressEvent.loaded;
            const bytesPerSecond = progressEvent.loaded / elapsed;
            estimatedTimeRemaining.value = remainingBytes / bytesPerSecond;
          }
        });
        success.value = true;
        emit("upload-success", response.data.path);
        fileInput.value.value = "";
        processingTime.value = (Date.now() - startTime.value) / 1e3;
        selectedFiles.value = [];
      } finally {
        loading.value = false;
        uploading.value = false;
      }
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$2, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), { title: "Upload File" }, null, _parent2, _scopeId));
            _push2(`<div class="flex h-full flex-col"${_scopeId}><div class="mt-6 flex-none"${_scopeId}>`);
            _push2(ssrRenderComponent(_sfc_main$1, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`File Upload`);
                } else {
                  return [
                    createTextVNode("File Upload")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<div class="flex h-full flex-row gap-8"${_scopeId}><div class="flex w-1/2 flex-col gap-4"${_scopeId}><div class="flex flex-col gap-2"${_scopeId}><label for="passphrase"${_scopeId}>Passphrase</label><input class="input input-bordered" id="passphrase" type="text"${ssrIncludeBooleanAttr(!selectedFiles.value.length) ? " disabled" : ""} placeholder="(*)@*@#14&amp;2kb"${_scopeId}></div><div class="flex flex-col gap-2"${_scopeId}><label for="nonce"${_scopeId}>Nonce (Optional)</label><input class="input input-bordered" id="nonce" type="text"${ssrIncludeBooleanAttr(!selectedFiles.value.length) ? " disabled" : ""}${_scopeId}></div><div class="form-control"${_scopeId}><label class="label cursor-pointer"${_scopeId}><span class="label-text"${_scopeId}>Sama dengan password akun</span>`);
            _push2(ssrRenderComponent(_sfc_main$3, null, null, _parent2, _scopeId));
            _push2(`</label></div><div class="mt-4 flex gap-4"${_scopeId}><input type="file" multiple class="file-input file-input-bordered w-full"${_scopeId}><button class="btn btn-primary w-fit"${ssrIncludeBooleanAttr(
              selectedFiles.value.length === 0 || uploading.value
            ) ? " disabled" : ""}${_scopeId}>${ssrInterpolate(uploading.value ? "Uploading..." : "Upload & Encrypt")}</button></div><div class="my-10 flex-1"${_scopeId}><div class="min-h-48 w-full rounded-lg bg-base-300 p-4"${_scopeId}><div class="flex flex-col"${_scopeId}><div class="mb-4 flex items-center gap-2"${_scopeId}><div class="badge font-bold"${_scopeId}> Output: </div></div><div class="flex flex-1 flex-row justify-between space-y-4"${_scopeId}><div class="flex flex-col gap-4"${_scopeId}><div${_scopeId}><span${_scopeId}>${ssrInterpolate(progress.value === 0 ? "Starting upload..." : progress.value < 100 ? "Upload in progress" : "Finalizing upload...")}</span>`);
            if (loading.value) {
              _push2(`<span class="loading loading-spinner ml-4 text-primary"${_scopeId}></span>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</div><div${_scopeId}><span${_scopeId}>Speed: ${ssrInterpolate(uploadSpeed.value)}</span></div><div class="font-mono"${_scopeId}> ETA: ${ssrInterpolate(formatTime(
              estimatedTimeRemaining.value ?? 0
            ))}</div></div><div class="radial-progress mr-10 text-primary" style="${ssrRenderStyle({
              "--value": progress.value,
              "--size": "6rem",
              "--thickness": "1rem"
            })}" role="progressbar"${_scopeId}>${ssrInterpolate(progress.value)}% </div></div></div></div></div></div><div class="divider divider-horizontal -mx-4"${_scopeId}></div><div class="flex w-1/2 flex-col"${_scopeId}><div class="h-full w-full rounded-lg"${_scopeId}>`);
            if (selectedFiles.value.length > 0) {
              _push2(`<div class="w-full"${_scopeId}><h3 class="mb-4 text-lg font-semibold"${_scopeId}> File terpilih </h3><div class="h-[500px] overflow-y-auto"${_scopeId}><ul class="menu menu-md w-full justify-start rounded-box"${_scopeId}><!--[-->`);
              ssrRenderList(selectedFiles.value, (file, index) => {
                _push2(`<li class="flex flex-row items-center justify-start rounded-lg p-3"${_scopeId}><div class="flex min-w-0 flex-1 flex-col items-start justify-start gap-1"${_scopeId}><span class="max-w-[200px] overflow-hidden truncate text-ellipsis text-left text-sm hover:overflow-visible hover:whitespace-normal"${ssrRenderAttr("title", file.name)}${_scopeId}>${ssrInterpolate(file.name)}</span><span class="badge badge-outline text-left text-xs"${_scopeId}>${ssrInterpolate(formatFileSize(
                  file.size
                ))}</span></div><button class="btn btn-ghost" type="button"${_scopeId}>`);
                _push2(ssrRenderComponent(unref(TrashIcon), { class: "size-5 text-error" }, null, _parent2, _scopeId));
                _push2(`</button></li>`);
              });
              _push2(`<!--]--></ul></div></div>`);
            } else {
              _push2(`<div class="mt-4 w-full text-center text-gray-500"${_scopeId}> Tidak ada file terpilih </div>`);
            }
            _push2(`</div></div></div></div></div>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Upload File" }),
              createVNode("div", { class: "flex h-full flex-col" }, [
                createVNode("div", { class: "mt-6 flex-none" }, [
                  createVNode(_sfc_main$1, null, {
                    default: withCtx(() => [
                      createTextVNode("File Upload")
                    ]),
                    _: 1
                  }),
                  createVNode("div", { class: "flex h-full flex-row gap-8" }, [
                    createVNode("div", { class: "flex w-1/2 flex-col gap-4" }, [
                      createVNode("div", { class: "flex flex-col gap-2" }, [
                        createVNode("label", { for: "passphrase" }, "Passphrase"),
                        createVNode("input", {
                          class: "input input-bordered",
                          id: "passphrase",
                          type: "text",
                          disabled: !selectedFiles.value.length,
                          placeholder: "(*)@*@#14&2kb"
                        }, null, 8, ["disabled"])
                      ]),
                      createVNode("div", { class: "flex flex-col gap-2" }, [
                        createVNode("label", { for: "nonce" }, "Nonce (Optional)"),
                        createVNode("input", {
                          class: "input input-bordered",
                          id: "nonce",
                          type: "text",
                          disabled: !selectedFiles.value.length
                        }, null, 8, ["disabled"])
                      ]),
                      createVNode("div", { class: "form-control" }, [
                        createVNode("label", { class: "label cursor-pointer" }, [
                          createVNode("span", { class: "label-text" }, "Sama dengan password akun"),
                          createVNode(_sfc_main$3)
                        ])
                      ]),
                      createVNode("div", { class: "mt-4 flex gap-4" }, [
                        createVNode("input", {
                          ref_key: "fileInput",
                          ref: fileInput,
                          type: "file",
                          multiple: "",
                          class: "file-input file-input-bordered w-full",
                          onChange: handleFileSelect
                        }, null, 544),
                        createVNode("button", {
                          onClick: uploadFile,
                          class: "btn btn-primary w-fit",
                          disabled: selectedFiles.value.length === 0 || uploading.value
                        }, toDisplayString(uploading.value ? "Uploading..." : "Upload & Encrypt"), 9, ["disabled"])
                      ]),
                      createVNode("div", { class: "my-10 flex-1" }, [
                        createVNode("div", { class: "min-h-48 w-full rounded-lg bg-base-300 p-4" }, [
                          createVNode("div", { class: "flex flex-col" }, [
                            createVNode("div", { class: "mb-4 flex items-center gap-2" }, [
                              createVNode("div", { class: "badge font-bold" }, " Output: ")
                            ]),
                            createVNode("div", { class: "flex flex-1 flex-row justify-between space-y-4" }, [
                              createVNode("div", { class: "flex flex-col gap-4" }, [
                                createVNode("div", null, [
                                  createVNode("span", null, toDisplayString(progress.value === 0 ? "Starting upload..." : progress.value < 100 ? "Upload in progress" : "Finalizing upload..."), 1),
                                  loading.value ? (openBlock(), createBlock("span", {
                                    key: 0,
                                    class: "loading loading-spinner ml-4 text-primary"
                                  })) : createCommentVNode("", true)
                                ]),
                                createVNode("div", null, [
                                  createVNode("span", null, "Speed: " + toDisplayString(uploadSpeed.value), 1)
                                ]),
                                createVNode("div", { class: "font-mono" }, " ETA: " + toDisplayString(formatTime(
                                  estimatedTimeRemaining.value ?? 0
                                )), 1)
                              ]),
                              createVNode("div", {
                                class: "radial-progress mr-10 text-primary",
                                style: {
                                  "--value": progress.value,
                                  "--size": "6rem",
                                  "--thickness": "1rem"
                                },
                                role: "progressbar"
                              }, toDisplayString(progress.value) + "% ", 5)
                            ])
                          ])
                        ])
                      ])
                    ]),
                    createVNode("div", { class: "divider divider-horizontal -mx-4" }),
                    createVNode("div", { class: "flex w-1/2 flex-col" }, [
                      createVNode("div", { class: "h-full w-full rounded-lg" }, [
                        selectedFiles.value.length > 0 ? (openBlock(), createBlock("div", {
                          key: 0,
                          class: "w-full"
                        }, [
                          createVNode("h3", { class: "mb-4 text-lg font-semibold" }, " File terpilih "),
                          createVNode("div", { class: "h-[500px] overflow-y-auto" }, [
                            createVNode("ul", { class: "menu menu-md w-full justify-start rounded-box" }, [
                              (openBlock(true), createBlock(Fragment, null, renderList(selectedFiles.value, (file, index) => {
                                return openBlock(), createBlock("li", {
                                  key: index,
                                  class: "flex flex-row items-center justify-start rounded-lg p-3"
                                }, [
                                  createVNode("div", { class: "flex min-w-0 flex-1 flex-col items-start justify-start gap-1" }, [
                                    createVNode("span", {
                                      class: "max-w-[200px] overflow-hidden truncate text-ellipsis text-left text-sm hover:overflow-visible hover:whitespace-normal",
                                      title: file.name
                                    }, toDisplayString(file.name), 9, ["title"]),
                                    createVNode("span", { class: "badge badge-outline text-left text-xs" }, toDisplayString(formatFileSize(
                                      file.size
                                    )), 1)
                                  ]),
                                  createVNode("button", {
                                    onClick: ($event) => removeFile(index),
                                    class: "btn btn-ghost",
                                    type: "button"
                                  }, [
                                    createVNode(unref(TrashIcon), { class: "size-5 text-error" })
                                  ], 8, ["onClick"])
                                ]);
                              }), 128))
                            ])
                          ])
                        ])) : (openBlock(), createBlock("div", {
                          key: 1,
                          class: "mt-4 w-full text-center text-gray-500"
                        }, " Tidak ada file terpilih "))
                      ])
                    ])
                  ])
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/FileUpload.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
