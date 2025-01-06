import { ref, onMounted, withCtx, unref, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderStyle } from "vue/server-renderer";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout-C9N4_aJT.js";
import { Head } from "@inertiajs/vue3";
import "@heroicons/vue/24/solid";
const _sfc_main = {
  __name: "Preferensi",
  __ssrInlineRender: true,
  setup(__props) {
    const tableData = ref([]);
    onMounted(async () => {
      try {
        const response = await fetch("/getranking");
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
            _push2(ssrRenderComponent(unref(Head), { title: "Preferensi" }, null, _parent2, _scopeId));
            _push2(`<div class="flex overflow-auto"${_scopeId}><table class="table table-zebra table-pin-cols"${_scopeId}><thead class="text-lg font-bold" style="${ssrRenderStyle({ "background-color": "hsl(0, 100%, 50%)" })}"${_scopeId}><tr${_scopeId}><th style="${ssrRenderStyle({ "width": "25%" })}"${_scopeId}>Kriteria</th><th style="${ssrRenderStyle({ "width": "25%" })}"${_scopeId}>Nama</th><th style="${ssrRenderStyle({ "width": "25%" })}"${_scopeId}>Bobot</th><th style="${ssrRenderStyle({ "width": "25%" })}"${_scopeId}>Atribut</th></tr></thead><tbody${_scopeId}><tr${_scopeId}><td${_scopeId}>A1</td><td${_scopeId}>1</td><td${_scopeId}></td><td${_scopeId}></td></tr></tbody></table></div>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Preferensi" }),
              createVNode("div", { class: "flex overflow-auto" }, [
                createVNode("table", { class: "table table-zebra table-pin-cols" }, [
                  createVNode("thead", {
                    class: "text-lg font-bold",
                    style: { "background-color": "hsl(0, 100%, 50%)" }
                  }, [
                    createVNode("tr", null, [
                      createVNode("th", { style: { "width": "25%" } }, "Kriteria"),
                      createVNode("th", { style: { "width": "25%" } }, "Nama"),
                      createVNode("th", { style: { "width": "25%" } }, "Bobot"),
                      createVNode("th", { style: { "width": "25%" } }, "Atribut")
                    ])
                  ]),
                  createVNode("tbody", null, [
                    createVNode("tr", null, [
                      createVNode("td", null, "A1"),
                      createVNode("td", null, "1"),
                      createVNode("td"),
                      createVNode("td")
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Preferensi.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
