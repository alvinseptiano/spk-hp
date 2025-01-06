import { onMounted, withCtx, unref, createTextVNode, createVNode, useSSRContext } from "vue";
import { ssrRenderComponent } from "vue/server-renderer";
import axios from "axios";
import { _ as _sfc_main$1 } from "./AuthenticatedLayout-C9N4_aJT.js";
import { Head } from "@inertiajs/vue3";
import { _ as _sfc_main$2 } from "./TextInput-B0jZlu5A.js";
import { P as PrimaryButton } from "./PrimaryButton-CbzYxQ0I.js";
import "@heroicons/vue/24/solid";
import "./_plugin-vue_export-helper-1tPrXgE0.js";
const _sfc_main = {
  __name: "Rekomendasi",
  __ssrInlineRender: true,
  setup(__props) {
    onMounted(() => {
      var _a;
      const token = (_a = document.querySelector('meta[name="csrf-token"]')) == null ? void 0 : _a.content;
      if (token) {
        axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), { title: "Rekomendasi" }, null, _parent2, _scopeId));
            _push2(`<div class="flex h-full flex-col"${_scopeId}><div class="w-32"${_scopeId}><div class="mockup-phone"${_scopeId}><div class="camera"${_scopeId}></div><div class="display"${_scopeId}><div class="artboard artboard-demo phone-1 text-center text-3xl font-bold"${_scopeId}> Rekomendasi smartphone anda adalah Xiaomi </div></div></div>`);
            _push2(ssrRenderComponent(PrimaryButton, null, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`Hello`);
                } else {
                  return [
                    createTextVNode("Hello")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(ssrRenderComponent(_sfc_main$2, null, null, _parent2, _scopeId));
            _push2(`</div></div>`);
          } else {
            return [
              createVNode(unref(Head), { title: "Rekomendasi" }),
              createVNode("div", { class: "flex h-full flex-col" }, [
                createVNode("div", { class: "w-32" }, [
                  createVNode("div", { class: "mockup-phone" }, [
                    createVNode("div", { class: "camera" }),
                    createVNode("div", { class: "display" }, [
                      createVNode("div", { class: "artboard artboard-demo phone-1 text-center text-3xl font-bold" }, " Rekomendasi smartphone anda adalah Xiaomi ")
                    ])
                  ]),
                  createVNode(PrimaryButton, null, {
                    default: withCtx(() => [
                      createTextVNode("Hello")
                    ]),
                    _: 1
                  }),
                  createVNode(_sfc_main$2)
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Rekomendasi.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
