import { ref, onMounted, withCtx, unref, createVNode, openBlock, createBlock, Fragment, renderList, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderList, ssrInterpolate } from "vue/server-renderer";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout-C9N4_aJT.js";
import { Head } from "@inertiajs/vue3";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/solid";
const _sfc_main = {
  __name: "Matrix",
  __ssrInlineRender: true,
  setup(__props) {
    const tableData = ref([]);
    onMounted(async () => {
      try {
        const response = await fetch("/getsmartphone");
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        tableData.value = await response.json();
        console.log("Response:", tableData.value);
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), { title: "Data Matrik" }, null, _parent2, _scopeId));
            _push2(`<div class="flex flex-col gap-4"${_scopeId}><div class="relative h-[calc(100vh-100px)] overflow-auto"${_scopeId}><table class="table table-pin-cols table-xs w-full"${_scopeId}><thead${_scopeId}><tr${_scopeId}><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Nama </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Harga </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Prosesor </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> RAM </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Internal </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Resolusi </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Baterai </th><th class="py-3 text-left text-xs font-medium uppercase"${_scopeId}> Aksi </th></tr></thead><tbody${_scopeId}><!--[-->`);
            ssrRenderList(tableData.value, (item) => {
              _push2(`<tr class="hover bg-base-200"${_scopeId}><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.name)}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
              }).format(item.price))}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.processor)}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.ram)}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.camera)}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.screen)}</th><th class="py-4 text-sm"${_scopeId}>${ssrInterpolate(item.battery)}</th><th class="py-4 text-sm"${_scopeId}><button class="btn btn-ghost btn-sm"${_scopeId}>`);
              _push2(ssrRenderComponent(unref(PencilSquareIcon), { class: "size-5" }, null, _parent2, _scopeId));
              _push2(`</button><button class="btn btn-ghost btn-sm"${_scopeId}>`);
              _push2(ssrRenderComponent(unref(TrashIcon), { class: "size-5 text-error" }, null, _parent2, _scopeId));
              _push2(`</button></th></tr>`);
            });
            _push2(`<!--]--></tbody></table></div></div>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Data Matrik" }),
              createVNode("div", { class: "flex flex-col gap-4" }, [
                createVNode("div", { class: "relative h-[calc(100vh-100px)] overflow-auto" }, [
                  createVNode("table", { class: "table table-pin-cols table-xs w-full" }, [
                    createVNode("thead", null, [
                      createVNode("tr", null, [
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Nama "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Harga "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Prosesor "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " RAM "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Internal "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Resolusi "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Baterai "),
                        createVNode("th", { class: "py-3 text-left text-xs font-medium uppercase" }, " Aksi ")
                      ])
                    ]),
                    createVNode("tbody", null, [
                      (openBlock(true), createBlock(Fragment, null, renderList(tableData.value, (item) => {
                        return openBlock(), createBlock("tr", {
                          key: item.id_hp,
                          class: "hover bg-base-200"
                        }, [
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.name), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR"
                          }).format(item.price)), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.processor), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.ram), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.camera), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.screen), 1),
                          createVNode("th", { class: "py-4 text-sm" }, toDisplayString(item.battery), 1),
                          createVNode("th", { class: "py-4 text-sm" }, [
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
                        ]);
                      }), 128))
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Matrix.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
