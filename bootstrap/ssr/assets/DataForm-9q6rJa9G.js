import { mergeProps, useSSRContext, ref, withCtx, unref, createVNode, createTextVNode, withModifiers, withDirectives, vModelText } from "vue";
import { ssrRenderAttrs, ssrRenderSlot, ssrRenderComponent, ssrRenderStyle, ssrRenderAttr } from "vue/server-renderer";
import { _ as _sfc_main$2 } from "./AuthenticatedLayout-C9N4_aJT.js";
import { Head } from "@inertiajs/vue3";
import { PlusCircleIcon, PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/solid";
import { _ as _export_sfc } from "./_plugin-vue_export-helper-1tPrXgE0.js";
import { P as PrimaryButton } from "./PrimaryButton-CbzYxQ0I.js";
const _sfc_main$1 = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  _push(`<button${ssrRenderAttrs(mergeProps({ class: "btn btn-accent w-36" }, _attrs))}>`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</button>`);
}
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Components/AccentButton.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const AccentButton = /* @__PURE__ */ _export_sfc(_sfc_main$1, [["ssrRender", _sfc_ssrRender]]);
const _sfc_main = {
  __name: "DataForm",
  __ssrInlineRender: true,
  emits: ["criteria-added"],
  setup(__props, { emit: __emit }) {
    const formData = ref({
      name: "",
      weight: null
    });
    const loading = ref(false);
    const submitForm = async () => {
      loading.value = true;
      try {
        const response = await axios.post("/add", formData.value);
        document.getElementById("criteria_modal").close();
        emit("criteria-added");
      } catch (error) {
        console.error("Error:", error);
      } finally {
        loading.value = false;
      }
    };
    const closeModal = () => {
      document.getElementById("alternative_modal").close();
      document.getElementById("criteria_modal").close();
    };
    const emit = __emit;
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$2, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), { title: "Input Data" }, null, _parent2, _scopeId));
            _push2(`<div role="tablist" class="tabs tabs-bordered"${_scopeId}><input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Alternatif" checked="checked"${_scopeId}><div role="tabpanel" class="tab-content p-6"${_scopeId}><div class="flex flex-col gap-4"${_scopeId}>`);
            _push2(ssrRenderComponent(AccentButton, { onclick: "alternative_modal.showModal()" }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(unref(PlusCircleIcon), { class: "size-5" }, null, _parent3, _scopeId2));
                  _push3(` Alternatif `);
                } else {
                  return [
                    createVNode(unref(PlusCircleIcon), { class: "size-5" }),
                    createTextVNode(" Alternatif ")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<table class="table table-zebra shadow-sm"${_scopeId}><thead class="bg-base-300 text-center font-bold"${_scopeId}><tr${_scopeId}><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Alternatif </th><th class="text-center"${_scopeId}>Nama</th><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Aksi </th></tr></thead><tbody class="text-center"${_scopeId}><tr${_scopeId}><td class="text-center"${_scopeId}>A1</td><td class="text-center"${_scopeId}>Redmi 9A</td><td class="flex justify-center gap-2"${_scopeId}><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(PencilSquareIcon), { class: "size-5" }, null, _parent2, _scopeId));
            _push2(`</button><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(TrashIcon), { class: "size-5 text-error" }, null, _parent2, _scopeId));
            _push2(`</button></td></tr></tbody></table></div></div><input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Kriteria"${_scopeId}><div role="tabpanel" class="tab-content p-10"${_scopeId}><div class="flex flex-col gap-4"${_scopeId}>`);
            _push2(ssrRenderComponent(AccentButton, { onclick: "criteria_modal.showModal()" }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(ssrRenderComponent(unref(PlusCircleIcon), { class: "size-5" }, null, _parent3, _scopeId2));
                  _push3(` Kriteria `);
                } else {
                  return [
                    createVNode(unref(PlusCircleIcon), { class: "size-5" }),
                    createTextVNode(" Kriteria ")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<table class="table table-zebra shadow-sm"${_scopeId}><thead class="bg-base-300 text-center"${_scopeId}><tr${_scopeId}><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Kriteria </th><th class="text-center"${_scopeId}>Nama</th><th class="text-center"${_scopeId}>Bobot</th><th class="text-center"${_scopeId}>Atribut</th><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Aksi </th></tr></thead><tbody class="text-center"${_scopeId}><tr${_scopeId}><td class="text-center"${_scopeId}>C1</td><td class="text-center"${_scopeId}>Resolusi Layar</td><td class="text-center"${_scopeId}>2.5</td><td class="text-center"${_scopeId}>Benefit</td><td class="flex justify-center gap-2"${_scopeId}><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(PencilSquareIcon), { class: "size-5" }, null, _parent2, _scopeId));
            _push2(`</button><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(TrashIcon), { class: "size-5 text-error" }, null, _parent2, _scopeId));
            _push2(`</button></td></tr></tbody></table></div></div><input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Sub Kriteria"${_scopeId}><div role="tabpanel" class="tab-content p-10"${_scopeId}><div class="flex flex-col gap-4"${_scopeId}><table class="table table-zebra shadow-sm"${_scopeId}><thead class="bg-base-300 text-center"${_scopeId}><tr${_scopeId}><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Kriteria </th><th class="text-center"${_scopeId}>Kriteria</th><th class="text-center"${_scopeId}>Sub Kriteria</th><th class="text-center"${_scopeId}>Nilai</th><th class="text-center" style="${ssrRenderStyle({ "width": "5%" })}"${_scopeId}> Aksi </th></tr></thead><tbody class="text-center"${_scopeId}><tr${_scopeId}><td class="text-center"${_scopeId}>C1</td><td class="text-center"${_scopeId}>Resolusi Layar</td><td class="text-center"${_scopeId}>FHD</td><td class="text-center"${_scopeId}>50</td><td class="flex justify-center gap-2"${_scopeId}><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(PencilSquareIcon), { class: "size-5" }, null, _parent2, _scopeId));
            _push2(`</button><button class="btn btn-ghost btn-sm"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(TrashIcon), { class: "size-5 text-error" }, null, _parent2, _scopeId));
            _push2(`</button></td></tr></tbody></table></div></div></div><dialog id="alternative_modal" class="modal"${_scopeId}><div class="modal-box"${_scopeId}><h3 class="text-lg font-bold"${_scopeId}>Tambah Alternatif</h3><div class="modal-action"${_scopeId}><form method="dialog"${_scopeId}><button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2"${_scopeId}> ✕ </button><div class="w-full"${_scopeId}><div class="flex flex-col gap-2"${_scopeId}><label for="passphrase"${_scopeId}>Bobot</label><input class="input input-bordered" id="passphrase" type="text" placeholder=""${_scopeId}></div><div class="flex flex-col gap-2"${_scopeId}><label for="passphrase"${_scopeId}>Bobot</label><input class="input input-bordered" id="passphrase" type="text" placeholder=""${_scopeId}></div></div></form></div></div></dialog><dialog id="criteria_modal" class="modal"${_scopeId}><div class="modal-box"${_scopeId}><h3 class="text-lg font-bold"${_scopeId}>Tambah Kriteria</h3><div class="modal-action"${_scopeId}><form${_scopeId}><button class="btn btn-circle btn-ghost btn-sm absolute right-2 top-2" type="button"${_scopeId}> ✕ </button><div class="flex flex-col gap-4"${_scopeId}><div class="flex flex-col gap-2"${_scopeId}><label for="alternative_name"${_scopeId}>Nama</label><input${ssrRenderAttr("value", formData.value.name)} class="input input-bordered" id="alternative_name" type="text"${_scopeId}></div><div class="flex flex-col gap-2"${_scopeId}><label for="alternative_weight"${_scopeId}>Bobot</label><input${ssrRenderAttr("value", formData.value.weight)} class="input input-bordered" id="alternative_weight" type="number"${_scopeId}></div>`);
            _push2(ssrRenderComponent(PrimaryButton, { loading: loading.value }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`Proses`);
                } else {
                  return [
                    createTextVNode("Proses")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`</div></form></div></div></dialog>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Input Data" }),
              createVNode("div", {
                role: "tablist",
                class: "tabs tabs-bordered"
              }, [
                createVNode("input", {
                  type: "radio",
                  name: "my_tabs_2",
                  role: "tab",
                  class: "tab",
                  "aria-label": "Alternatif",
                  checked: "checked"
                }),
                createVNode("div", {
                  role: "tabpanel",
                  class: "tab-content p-6"
                }, [
                  createVNode("div", { class: "flex flex-col gap-4" }, [
                    createVNode(AccentButton, { onclick: "alternative_modal.showModal()" }, {
                      default: withCtx(() => [
                        createVNode(unref(PlusCircleIcon), { class: "size-5" }),
                        createTextVNode(" Alternatif ")
                      ]),
                      _: 1
                    }),
                    createVNode("table", { class: "table table-zebra shadow-sm" }, [
                      createVNode("thead", { class: "bg-base-300 text-center font-bold" }, [
                        createVNode("tr", null, [
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Alternatif "),
                          createVNode("th", { class: "text-center" }, "Nama"),
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Aksi ")
                        ])
                      ]),
                      createVNode("tbody", { class: "text-center" }, [
                        createVNode("tr", null, [
                          createVNode("td", { class: "text-center" }, "A1"),
                          createVNode("td", { class: "text-center" }, "Redmi 9A"),
                          createVNode("td", { class: "flex justify-center gap-2" }, [
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(PencilSquareIcon), { class: "size-5" })
                            ], 8, ["onClick"]),
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(TrashIcon), { class: "size-5 text-error" })
                            ], 8, ["onClick"])
                          ])
                        ])
                      ])
                    ])
                  ])
                ]),
                createVNode("input", {
                  type: "radio",
                  name: "my_tabs_2",
                  role: "tab",
                  class: "tab",
                  "aria-label": "Kriteria"
                }),
                createVNode("div", {
                  role: "tabpanel",
                  class: "tab-content p-10"
                }, [
                  createVNode("div", { class: "flex flex-col gap-4" }, [
                    createVNode(AccentButton, { onclick: "criteria_modal.showModal()" }, {
                      default: withCtx(() => [
                        createVNode(unref(PlusCircleIcon), { class: "size-5" }),
                        createTextVNode(" Kriteria ")
                      ]),
                      _: 1
                    }),
                    createVNode("table", { class: "table table-zebra shadow-sm" }, [
                      createVNode("thead", { class: "bg-base-300 text-center" }, [
                        createVNode("tr", null, [
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Kriteria "),
                          createVNode("th", { class: "text-center" }, "Nama"),
                          createVNode("th", { class: "text-center" }, "Bobot"),
                          createVNode("th", { class: "text-center" }, "Atribut"),
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Aksi ")
                        ])
                      ]),
                      createVNode("tbody", { class: "text-center" }, [
                        createVNode("tr", null, [
                          createVNode("td", { class: "text-center" }, "C1"),
                          createVNode("td", { class: "text-center" }, "Resolusi Layar"),
                          createVNode("td", { class: "text-center" }, "2.5"),
                          createVNode("td", { class: "text-center" }, "Benefit"),
                          createVNode("td", { class: "flex justify-center gap-2" }, [
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(PencilSquareIcon), { class: "size-5" })
                            ], 8, ["onClick"]),
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(TrashIcon), { class: "size-5 text-error" })
                            ], 8, ["onClick"])
                          ])
                        ])
                      ])
                    ])
                  ])
                ]),
                createVNode("input", {
                  type: "radio",
                  name: "my_tabs_2",
                  role: "tab",
                  class: "tab",
                  "aria-label": "Sub Kriteria"
                }),
                createVNode("div", {
                  role: "tabpanel",
                  class: "tab-content p-10"
                }, [
                  createVNode("div", { class: "flex flex-col gap-4" }, [
                    createVNode("table", { class: "table table-zebra shadow-sm" }, [
                      createVNode("thead", { class: "bg-base-300 text-center" }, [
                        createVNode("tr", null, [
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Kriteria "),
                          createVNode("th", { class: "text-center" }, "Kriteria"),
                          createVNode("th", { class: "text-center" }, "Sub Kriteria"),
                          createVNode("th", { class: "text-center" }, "Nilai"),
                          createVNode("th", {
                            class: "text-center",
                            style: { "width": "5%" }
                          }, " Aksi ")
                        ])
                      ]),
                      createVNode("tbody", { class: "text-center" }, [
                        createVNode("tr", null, [
                          createVNode("td", { class: "text-center" }, "C1"),
                          createVNode("td", { class: "text-center" }, "Resolusi Layar"),
                          createVNode("td", { class: "text-center" }, "FHD"),
                          createVNode("td", { class: "text-center" }, "50"),
                          createVNode("td", { class: "flex justify-center gap-2" }, [
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(PencilSquareIcon), { class: "size-5" })
                            ], 8, ["onClick"]),
                            createVNode("button", {
                              class: "btn btn-ghost btn-sm",
                              onClick: _ctx.handleDelete
                            }, [
                              createVNode(unref(TrashIcon), { class: "size-5 text-error" })
                            ], 8, ["onClick"])
                          ])
                        ])
                      ])
                    ])
                  ])
                ])
              ]),
              createVNode("dialog", {
                id: "alternative_modal",
                class: "modal"
              }, [
                createVNode("div", { class: "modal-box" }, [
                  createVNode("h3", { class: "text-lg font-bold" }, "Tambah Alternatif"),
                  createVNode("div", { class: "modal-action" }, [
                    createVNode("form", { method: "dialog" }, [
                      createVNode("button", { class: "btn btn-circle btn-ghost btn-sm absolute right-2 top-2" }, " ✕ "),
                      createVNode("div", { class: "w-full" }, [
                        createVNode("div", { class: "flex flex-col gap-2" }, [
                          createVNode("label", { for: "passphrase" }, "Bobot"),
                          createVNode("input", {
                            class: "input input-bordered",
                            id: "passphrase",
                            type: "text",
                            placeholder: ""
                          })
                        ]),
                        createVNode("div", { class: "flex flex-col gap-2" }, [
                          createVNode("label", { for: "passphrase" }, "Bobot"),
                          createVNode("input", {
                            class: "input input-bordered",
                            id: "passphrase",
                            type: "text",
                            placeholder: ""
                          })
                        ])
                      ])
                    ])
                  ])
                ])
              ]),
              createVNode("dialog", {
                id: "criteria_modal",
                class: "modal"
              }, [
                createVNode("div", { class: "modal-box" }, [
                  createVNode("h3", { class: "text-lg font-bold" }, "Tambah Kriteria"),
                  createVNode("div", { class: "modal-action" }, [
                    createVNode("form", {
                      onSubmit: withModifiers(submitForm, ["prevent"])
                    }, [
                      createVNode("button", {
                        class: "btn btn-circle btn-ghost btn-sm absolute right-2 top-2",
                        type: "button",
                        onClick: closeModal
                      }, " ✕ "),
                      createVNode("div", { class: "flex flex-col gap-4" }, [
                        createVNode("div", { class: "flex flex-col gap-2" }, [
                          createVNode("label", { for: "alternative_name" }, "Nama"),
                          withDirectives(createVNode("input", {
                            "onUpdate:modelValue": ($event) => formData.value.name = $event,
                            class: "input input-bordered",
                            id: "alternative_name",
                            type: "text"
                          }, null, 8, ["onUpdate:modelValue"]), [
                            [vModelText, formData.value.name]
                          ])
                        ]),
                        createVNode("div", { class: "flex flex-col gap-2" }, [
                          createVNode("label", { for: "alternative_weight" }, "Bobot"),
                          withDirectives(createVNode("input", {
                            "onUpdate:modelValue": ($event) => formData.value.weight = $event,
                            class: "input input-bordered",
                            id: "alternative_weight",
                            type: "number"
                          }, null, 8, ["onUpdate:modelValue"]), [
                            [vModelText, formData.value.weight]
                          ])
                        ]),
                        createVNode(PrimaryButton, { loading: loading.value }, {
                          default: withCtx(() => [
                            createTextVNode("Proses")
                          ]),
                          _: 1
                        }, 8, ["loading"])
                      ])
                    ], 32)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/DataForm.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
