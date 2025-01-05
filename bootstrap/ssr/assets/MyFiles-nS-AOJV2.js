import { ref, computed, onMounted, withCtx, unref, createVNode, openBlock, createBlock, Fragment, renderList, toDisplayString, createCommentVNode, withDirectives, vModelText, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderList, ssrInterpolate, ssrRenderClass, ssrRenderAttr } from "vue/server-renderer";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout-DALFCgFp.js";
import axios from "axios";
import { ExclamationTriangleIcon } from "@heroicons/vue/24/solid";
import "@inertiajs/vue3";
const _sfc_main = {
  __name: "MyFiles",
  __ssrInlineRender: true,
  setup(__props) {
    const currentPath = ref("");
    const items = ref([]);
    const showNewFolderModal = ref(false);
    const newFolderName = ref("");
    const fileInput = ref(null);
    const pathSegments = computed(() => {
      return currentPath.value ? currentPath.value.split("/") : [];
    });
    const fetchItems = async () => {
      try {
        const response = await axios.get(
          `/api/file-manager?path=${currentPath.value}`
        );
        items.value = response.data.items;
      } catch (error) {
        console.error("Error fetching items:", error);
      }
    };
    const navigateToPath = (path) => {
      currentPath.value = path;
      fetchItems();
    };
    const getPathUpToIndex = (index) => {
      return pathSegments.value.slice(0, index + 1).join("/");
    };
    const handleFileUpload = async (event) => {
      const file = event.target.files[0];
      if (!file) return;
      const formData = new FormData();
      formData.append("file", file);
      formData.append("path", currentPath.value);
      try {
        await axios.post("/api/file-manager/upload", formData);
        fetchItems();
      } catch (error) {
        console.error("Error uploading file:", error);
      }
    };
    const createFolder = async () => {
      if (!newFolderName.value) return;
      try {
        await axios.post("/api/file-manager/create-directory", {
          path: currentPath.value,
          name: newFolderName.value
        });
        showNewFolderModal.value = false;
        newFolderName.value = "";
        fetchItems();
      } catch (error) {
        console.error("Error creating folder:", error);
      }
    };
    const deleteItem = async (item) => {
      if (!confirm(`Are you sure you want to delete ${item.name}?`)) return;
      try {
        await axios.delete("/api/file-manager/delete", {
          data: {
            path: item.path,
            is_file: item.is_file
          }
        });
        fetchItems();
      } catch (error) {
        console.error("Error deleting item:", error);
      }
    };
    const downloadFile = (path) => {
      window.location.href = `/api/file-manager/download/${encodeURIComponent(path)}`;
    };
    const formatSize = (bytes) => {
      const units = ["B", "KB", "MB", "GB"];
      let size = bytes;
      let unitIndex = 0;
      while (size >= 1024 && unitIndex < units.length - 1) {
        size /= 1024;
        unitIndex++;
      }
      return `${size.toFixed(1)} ${units[unitIndex]}`;
    };
    const formatDate = (timestamp) => {
      return new Date(timestamp * 1e3).toLocaleString();
    };
    onMounted(() => {
      fetchItems();
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="flex flex-col gap-4"${_scopeId}><div class="file-manager flex flex-col overflow-auto"${_scopeId}><div class="my-4 flex-1 items-center justify-between"${_scopeId}>`);
            {
              _push2(`<div class="mb-4 block"${_scopeId}><div role="alert" class="alert"${_scopeId}>`);
              _push2(ssrRenderComponent(unref(ExclamationTriangleIcon), { class: "h-5 w-5 text-error" }, null, _parent2, _scopeId));
              _push2(`<span${_scopeId}>Error Request</span></div></div>`);
            }
            _push2(`<div class="breadcrumbs rounded-lg bg-base-200 text-lg"${_scopeId}><ul class="flex items-center"${_scopeId}><li${_scopeId}><button class="px-2 text-lg text-accent"${_scopeId}> .. </button></li><li${_scopeId}><!--[-->`);
            ssrRenderList(pathSegments.value, (segment, index) => {
              _push2(`<button class="px-2 text-lg text-accent"${_scopeId}>${ssrInterpolate(segment)}</button>`);
            });
            _push2(`<!--]--></li></ul></div><div class="flex items-center space-x-2"${_scopeId}><div class="relative"${_scopeId}><input type="file" class="hidden"${_scopeId}></div><button class="rounded p-2"${_scopeId}><div class="flex items-center space-x-4"${_scopeId}><div class="pi pi-trash"${_scopeId}></div><div class="pi pi-download mr-5"${_scopeId}></div><div class="pi pi-folder-plus"${_scopeId}></div></div></button></div></div><div class="rounded-lg bg-base-100"${_scopeId}><div class="overflow-auto"${_scopeId}><table class="table table-pin-rows table-sm z-10 w-full"${_scopeId}><thead${_scopeId}><tr${_scopeId}><th${_scopeId}><label${_scopeId}><input type="checkbox" class="checkbox"${_scopeId}></label></th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Name </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Size </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Last Modified </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Actions </th></tr></thead><tbody${_scopeId}><!--[-->`);
            ssrRenderList(items.value, (item) => {
              _push2(`<tr class="hover bg-base-200"${_scopeId}><td${_scopeId}><label${_scopeId}><input type="checkbox" class="checkbox"${_scopeId}></label></td><td class="py-4"${_scopeId}><div class="flex items-center"${_scopeId}>`);
              if (item.is_file) {
                _push2(`<span class="pi pi-file mr-2"${_scopeId}></span>`);
              } else {
                _push2(`<span class="pi pi-folder mr-2"${_scopeId}></span>`);
              }
              _push2(`<button class="text-sm"${_scopeId}>${ssrInterpolate(item.name)}</button></div></td><td class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.is_file ? formatSize(item.size) : "-")}</td><td class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.is_file ? formatDate(item.last_modified) : "-")}</td><td class="py-4 text-sm"${_scopeId}><div class="dropdown dropdown-end"${_scopeId}><button tabindex="0" class="pi pi-ellipsis-v"${_scopeId}></button><ul tabindex="0" class="menu dropdown-content rounded-box bg-base-200 p-2 shadow"${_scopeId}><li${_scopeId}>`);
              if (item.is_file) {
                _push2(`<button${_scopeId}> Download </button>`);
              } else {
                _push2(`<!---->`);
              }
              _push2(`</li><li${_scopeId}><button class="text-error"${_scopeId}> Delete </button></li></ul></div></td></tr>`);
            });
            _push2(`<!--]--></tbody></table></div></div></div><dialog class="${ssrRenderClass(["modal", { "modal-open": showNewFolderModal.value }])}"${_scopeId}><div class="modal-box"${_scopeId}><h3 class="mb-4 text-lg font-medium"${_scopeId}>Create New Folder</h3><div class="modal-action"${_scopeId}><form method="dialog" class="w-full"${_scopeId}><input${ssrRenderAttr("value", newFolderName.value)} type="text" placeholder="Folder name" class="mb-4 w-full rounded border px-3 py-2"${_scopeId}><div class="flex justify-end gap-2"${_scopeId}><button class="btn btn-error"${_scopeId}> Close </button><button class="btn btn-success"${_scopeId}> Create </button></div></form></div></div></dialog></div>`);
          } else {
            return [
              createVNode("div", { class: "flex flex-col gap-4" }, [
                createVNode("div", { class: "file-manager flex flex-col overflow-auto" }, [
                  createVNode("div", { class: "my-4 flex-1 items-center justify-between" }, [
                    (openBlock(), createBlock("div", {
                      key: 0,
                      class: "mb-4 block"
                    }, [
                      createVNode("div", {
                        role: "alert",
                        class: "alert"
                      }, [
                        createVNode(unref(ExclamationTriangleIcon), { class: "h-5 w-5 text-error" }),
                        createVNode("span", null, "Error Request")
                      ])
                    ])),
                    createVNode("div", { class: "breadcrumbs rounded-lg bg-base-200 text-lg" }, [
                      createVNode("ul", { class: "flex items-center" }, [
                        createVNode("li", null, [
                          createVNode("button", {
                            onClick: ($event) => navigateToPath(""),
                            class: "px-2 text-lg text-accent"
                          }, " .. ", 8, ["onClick"])
                        ]),
                        createVNode("li", null, [
                          (openBlock(true), createBlock(Fragment, null, renderList(pathSegments.value, (segment, index) => {
                            return openBlock(), createBlock("button", {
                              key: index,
                              onClick: ($event) => navigateToPath(
                                getPathUpToIndex(index)
                              ),
                              class: "px-2 text-lg text-accent"
                            }, toDisplayString(segment), 9, ["onClick"]);
                          }), 128))
                        ])
                      ])
                    ]),
                    createVNode("div", { class: "flex items-center space-x-2" }, [
                      createVNode("div", { class: "relative" }, [
                        createVNode("input", {
                          type: "file",
                          ref_key: "fileInput",
                          ref: fileInput,
                          onChange: handleFileUpload,
                          class: "hidden"
                        }, null, 544)
                      ]),
                      createVNode("button", {
                        onClick: ($event) => showNewFolderModal.value = true,
                        class: "rounded p-2"
                      }, [
                        createVNode("div", { class: "flex items-center space-x-4" }, [
                          createVNode("div", { class: "pi pi-trash" }),
                          createVNode("div", { class: "pi pi-download mr-5" }),
                          createVNode("div", { class: "pi pi-folder-plus" })
                        ])
                      ], 8, ["onClick"])
                    ])
                  ]),
                  createVNode("div", { class: "rounded-lg bg-base-100" }, [
                    createVNode("div", { class: "overflow-auto" }, [
                      createVNode("table", { class: "table table-pin-rows table-sm z-10 w-full" }, [
                        createVNode("thead", null, [
                          createVNode("tr", null, [
                            createVNode("th", null, [
                              createVNode("label", null, [
                                createVNode("input", {
                                  type: "checkbox",
                                  class: "checkbox"
                                })
                              ])
                            ]),
                            createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Name "),
                            createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Size "),
                            createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Last Modified "),
                            createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Actions ")
                          ])
                        ]),
                        createVNode("tbody", null, [
                          (openBlock(true), createBlock(Fragment, null, renderList(items.value, (item) => {
                            return openBlock(), createBlock("tr", {
                              key: item.path,
                              class: "hover bg-base-200"
                            }, [
                              createVNode("td", null, [
                                createVNode("label", null, [
                                  createVNode("input", {
                                    type: "checkbox",
                                    class: "checkbox"
                                  })
                                ])
                              ]),
                              createVNode("td", { class: "py-4" }, [
                                createVNode("div", { class: "flex items-center" }, [
                                  item.is_file ? (openBlock(), createBlock("span", {
                                    key: 0,
                                    class: "pi pi-file mr-2"
                                  })) : (openBlock(), createBlock("span", {
                                    key: 1,
                                    class: "pi pi-folder mr-2"
                                  })),
                                  createVNode("button", {
                                    onClick: ($event) => item.is_file ? downloadFile(
                                      item.path
                                    ) : navigateToPath(
                                      item.path
                                    ),
                                    class: "text-sm"
                                  }, toDisplayString(item.name), 9, ["onClick"])
                                ])
                              ]),
                              createVNode("td", { class: "py-4 text-sm" }, toDisplayString(item.is_file ? formatSize(item.size) : "-"), 1),
                              createVNode("td", { class: "py-4 text-sm" }, toDisplayString(item.is_file ? formatDate(item.last_modified) : "-"), 1),
                              createVNode("td", { class: "py-4 text-sm" }, [
                                createVNode("div", { class: "dropdown dropdown-end" }, [
                                  createVNode("button", {
                                    tabindex: "0",
                                    class: "pi pi-ellipsis-v"
                                  }),
                                  createVNode("ul", {
                                    tabindex: "0",
                                    class: "menu dropdown-content rounded-box bg-base-200 p-2 shadow"
                                  }, [
                                    createVNode("li", null, [
                                      item.is_file ? (openBlock(), createBlock("button", {
                                        key: 0,
                                        onClick: ($event) => downloadFile(
                                          item.path
                                        )
                                      }, " Download ", 8, ["onClick"])) : createCommentVNode("", true)
                                    ]),
                                    createVNode("li", null, [
                                      createVNode("button", {
                                        onClick: ($event) => deleteItem(item),
                                        class: "text-error"
                                      }, " Delete ", 8, ["onClick"])
                                    ])
                                  ])
                                ])
                              ])
                            ]);
                          }), 128))
                        ])
                      ])
                    ])
                  ])
                ]),
                createVNode("dialog", {
                  class: ["modal", { "modal-open": showNewFolderModal.value }]
                }, [
                  createVNode("div", { class: "modal-box" }, [
                    createVNode("h3", { class: "mb-4 text-lg font-medium" }, "Create New Folder"),
                    createVNode("div", { class: "modal-action" }, [
                      createVNode("form", {
                        method: "dialog",
                        class: "w-full"
                      }, [
                        withDirectives(createVNode("input", {
                          "onUpdate:modelValue": ($event) => newFolderName.value = $event,
                          type: "text",
                          placeholder: "Folder name",
                          class: "mb-4 w-full rounded border px-3 py-2"
                        }, null, 8, ["onUpdate:modelValue"]), [
                          [vModelText, newFolderName.value]
                        ]),
                        createVNode("div", { class: "flex justify-end gap-2" }, [
                          createVNode("button", {
                            onClick: ($event) => showNewFolderModal.value = false,
                            class: "btn btn-error"
                          }, " Close ", 8, ["onClick"]),
                          createVNode("button", {
                            onClick: createFolder,
                            class: "btn btn-success"
                          }, " Create ")
                        ])
                      ])
                    ])
                  ])
                ], 2)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/MyFiles.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
